<?php

namespace Service;

/**
 * Import class 
 * @author		Tomasz Cisowski <t.cisowski@gmail.com>
 * @version		1.0
 */
class Import {

	const PIZZA_CATEGORY = 'Pizza';

	/*
	 * @var DOMDocument value $_importContent
	 */

	protected $_importContent = '';

	/**
	 *
	 * @var array error list $errorContainer
	 */
	public $errorContainer = array();

	/**
	 * Seter for dom object
	 * 
	 * @param \DOMDocument $importContent
	 * 
	 * @author Tomasz Cisowski <t.cisowski@gmail.com>
	 * @return void
	 */
	Public function setImportContent(\DOMDocument $importContent) {
		$this->_importContent = $importContent;
	}

	/**
	 * Main import function
	 * 
	 * @author Tomasz Cisowski <t.cisowski@gmail.com>
	 * @return void
	 */
	public function import() {

		$oProduct = $this->_importContent->getElementsByTagName('product');
		foreach ($oProduct as $key => $product) {

			$productName = trim($product->getElementsByTagName('name')->item(0)->nodeValue);

			/**
			 * Validation conditions
			 */
			$this->validate($product, $key, $productName);
			if (!isset($this->errorContainer[$key])) {

				$productId = $this->_importProduct($product);
				if ($product->getElementsByTagName('attributes')->item(0)->hasChildNodes()) {
					$this->_importAttr($product, $productId);
				}
			}
		}
	}
	
	/**
	 * Insert/update product
	 * 
	 * @param DOMElement $product
	 * 
	 * @author Tomasz Cisowski <t.cisowski@gmail.com>
	 * @return int
	 */
	protected function _importProduct($product) {
		
		$productRepository = new \ProductRepository();
		$ormProduct = $productRepository->getProductByName(trim($product->getElementsByTagName('name')->item(0)->nodeValue));

		if (!$ormProduct) {
			$ormProduct = \ORM::for_table('product')->create();
		}

		$ormProduct->name = trim($product->getElementsByTagName('name')->item(0)->nodeValue);
		$ormProduct->description = trim($product->getElementsByTagName('description')->item(0)->nodeValue);
		$ormProduct->cost = $product->getElementsByTagName('price')->item(0)->nodeValue;

		$ormProduct->cat_id = $this->_importCategory($product);
		$ormProduct->save();
		
		return $ormProduct->id();
	}

	/**
	 * Insert/update attribute
	 * 
	 * @param DOMElement $product
	 * @param int $productId
	 * 
	 * @author Tomasz Cisowski <t.cisowski@gmail.com>
	 * @return void
	 */
	protected function _importAttr($product, $productId) {

		$attrRepository = new \Repository\AttrRepository();

		\ORM::for_table('attr2pizza')
				->where('pizza_id', $productId)
				->delete_many();

		$oAttr = $product->getElementsByTagName('attribute');
		foreach ($oAttr as $attr) {

			$ormAttr = $attrRepository->getAttrByName(trim($attr->nodeValue));
			if (!$ormAttr) {
				$ormAttr = \ORM::for_table('attr')->create();
				$ormAttr->name = trim($attr->nodeValue);
				$ormAttr->save();
			}

			$ormPizza = \ORM::for_table('attr2pizza')->create();
			$ormPizza->pizza_id = $productId;
			$ormPizza->attr_id = $ormAttr->id();
			$ormPizza->save();
		}
	}

	/**
	 * Insert/update category
	 * 
	 * @param DOMElement $product
	 * 
	 * @author Tomasz Cisowski <t.cisowski@gmail.com>
	 * @return int
	 */
	protected function _importCategory($product) {
		
		$categoryRepository = new \Repository\CategoriesRepository();
		$ormCategory = $categoryRepository->getCategoryByName(trim($product->getElementsByTagName('category')->item(0)->nodeValue));

		if (!$ormCategory) {
			$ormCategory = \ORM::for_table('categories')->create();
			$ormCategory->name = trim($product->getElementsByTagName('category')->item(0)->nodeValue);
			$ormCategory->save();
		}
		
		return $ormCategory->id();
	}

	/**
	 * Method to validate xml structure
	 * 
	 * @param \DOMElement $product
	 * @param int $key
	 * @param string $productName
	 * 
	 * @author Tomasz Cisowski <t.cisowski@gmail.com>
	 * @return boolean
	 */
	public function validate(\DOMElement $product, $key, $productName) {

		/**
		 * Product schema validate
		 */
		$dom = new \DOMDocument();
		$dom->loadXML($product->ownerDocument->saveXML($product));

		if (!$dom->schemaValidate('vendor/xsd/product.xsd')) {
			$this->errorContainer[$key][] = "[$productName] Structure of product XML is not valid";
			return false;
		}

		if ($product->getElementsByTagName('category')->item(0)->nodeValue == self::PIZZA_CATEGORY) {

			if (!empty($product->getElementsByTagName('description')->item(0)->nodeValue)) {
				$this->errorContainer[$key][] = "[$productName] Pizza category and description must be empty!";
			}

			if (!($product->getElementsByTagName('attributes')->item(0)->hasChildNodes())) {
				$this->errorContainer[$key][] = "[$productName] Pizza category and attributes are empty!";
			}
		} else {

			if (empty($product->getElementsByTagName('description')->item(0)->nodeValue)) {
				$this->errorContainer[$key][] = "[$productName] No pizza category and description is empty!";
			}

			if (($product->getElementsByTagName('attributes')->item(0)->hasChildNodes())) {
				$this->errorContainer[$key][] = "[$productName] No pizza category and attributes are not empty!";
			}
		}
	}

	/**
	 * Method to file log save
	 * 
	 * @param string $filename
	 * 
	 * @author Tomasz Cisowski <t.cisowski@gmail.com>
	 * @return boolean
	 */
	public function renderErrorToFile($filename) {

		if (!empty($this->errorContainer) && count($this->errorContainer) > 0) {
			file_put_contents($filename . '_import_error_log.txt', print_r($this->errorContainer, true));
			return true;
		}

		return false;
	}

}
