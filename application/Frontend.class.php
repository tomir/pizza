<?php
/**
 * (Controller-) Class for Public-View
 *
 * @author     Tomasz Cisowski
 * @version    1.0
 */
class Frontend extends Controller {

    /**
     * Renders the start page
     *
     * @author Tomasz Cisowski
     * @return void
     */
    public function homeAction()
    {
        $this->addTplParam( 'url', 'menu-pizza.html' );
        $this->render('index');
    }

    /**
     * Renders the main page
     *
     * @author Tomasz Cisowski
     * @return void
     */
    public function mainAction()
    {
        $sNameSpies = $_GET['spies'];

        $oProductInfo = $this->_getProductReposirty()->getProductByCategory( $sNameSpies );

        $this->addTplParam( 'sNameSpies', $sNameSpies );
        $this->addTplParam( 'oProductInfo', $oProductInfo );

        $this->render('menu');
    }

}