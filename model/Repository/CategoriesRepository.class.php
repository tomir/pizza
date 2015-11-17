<?php

namespace Repository;

/**
 * Categories repository for Categories Model
 * @author		Tomasz Cisowski <t.cisowski@gmail.com>
 * @version		1.0
 */
class CategoriesRepository {
	
	/**
     * Get category by name
     *
     * @author Tomasz Cisowski <t.cisowski@gmail.com>
     * @param  string $sCategoryName category name
     * @return object
     */
	public function getCategoryByName( $sCategoryName )
    {
        return \Model::factory('categories')
                    ->select('categories.*')
                    ->where('categories.name', $sCategoryName)
                    ->find_one();
    }
	
}
