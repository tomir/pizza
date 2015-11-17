<?php

/**
 * (Controller-) Class for Admin-View
 * @author		Tomasz Cisowski
 * @author		Tomasz Cisowski <t.cisowski@gmail.com>
 * @version		1.0
 */
class Backend extends Controller  {

    /**
     * Renders the admin page
     *
     * @author Tomasz Cisowski
     * @return void
     */
    public function showProduct()
    {
        $oProductInfo = $this->_getProductReposirty()->getAllProduct();

        $this->addTplParam( 'oProductInfo', $oProductInfo );
        $this->addTplParam( 'url', 'menu-pizza.html' );

        $this->render('admin');
    }
	
	/**
     * Import xml file
     *
     * @author Tomasz Cisowski <t.cisowski@gmail.com>
     * @return void
     */
	public function importFile() {
		
		if(isset($_FILES) && !empty($_FILES) && $_FILES['importedFile']['size'] > 0) {
			if($_FILES['importedFile']['type'] == 'text/xml') {
				
				$tmp_name = $_FILES["importedFile"]["tmp_name"];
				$saveName = 'tmp/'.$_FILES["importedFile"]["name"];
				move_uploaded_file($tmp_name, $saveName);
				
				$dom = new DOMDocument();
				$dom->load($saveName);
						
				$objImportService = new \Service\Import();
				$objImportService->setImportContent($dom);
				
				$objImportService->import();
				$error = $objImportService->renderErrorToFile($_FILES["importedFile"]["name"]);
				unlink($saveName);
				
				$this->addTplParam( 'error', $error );
				
			} else {
				$this->addTplParam( 'error', 'type' );
			}
		} else {
			$this->addTplParam( 'error', 'file' );
		}
		
		$this->showProduct();
	}

}