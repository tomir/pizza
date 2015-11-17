<?php
/**
 * ProductRepostry fpr Product Model
 * @author     Tomasz Cisowski
 * @version    1.0
 */
class ProductRepository
{
    /**
     * Get alle product by Category
     *
     * @author Tomasz Cisowski
     * @param  string $sCategoryName category name
     * @return object
     */
    public function getProductByCategory( $sCategoryName )
    {
        return Model::factory('product')
                    ->select('product.*')
                    ->join('categories', ['product.cat_id', '=', 'categories.id'])
                    ->where('categories.name', $sCategoryName)
                    ->order_by_asc('pos')
                    ->find_many();
    }

    /**
     * Get all product
     *
     * @author Tomasz Cisowski
     * @return object
     */
    public function getAllProduct()
    {
        return Model::factory('product')
            ->select('product.*' )
            ->select('categories.name', 'catname' )
            ->join('categories', ['product.cat_id', '=', 'categories.id'])
            ->order_by_asc('categories.id')
            ->order_by_asc('pos')
            ->find_many();
    }
	
	/**
     * Get product by name
     *
     * @author Tomasz Cisowski <t.cisowski@gmail.com>
     * @param  string $sProductName product name
     * @return object
     */
	public function getProductByName( $sProductName )
    {
        return Model::factory('product')
                    ->select('product.*')
                    ->where('product.name', $sProductName)
                    ->find_one();
    }


}