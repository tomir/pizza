<?php
/**
 * Product ORM Model
 *
 * @author		Tomasz Cisowski
 * @author		Tomasz Cisowski <t.cisowski@gmail.com>
 * @version		1.0
 */
class Product extends Model {

    /**
     * @todo Get all attributes for pizza product
     *
	 * @author Tomasz Cisowski <t.cisowski@gmail.com>
     * @return string
     */
    protected function _getPizzaAttr()
    {
        $objAttrRepository = new \Repository\AttrRepository();
		return $objAttrRepository->getAttrNameCollection($this->id);
    }

    /**
     * Get product description.
     * For Pizza product -> all attributes
     *
     * @author Tomasz Cisowski
     * @return string
     */
    public function getDescription()
    {
        return ((int)$this->cat_id === 1)
                ? $this->_getPizzaAttr()
                : $this->description;

    }
}