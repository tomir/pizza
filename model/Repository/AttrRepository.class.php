<?php

namespace Repository;

/**
 * Attribute repository for Attribute Model
 * @author		Tomasz Cisowski <t.cisowski@gmail.com>
 * @version		1.0
 */
class AttrRepository {
	
	/**
     * Get all attributes for product
     *
     * @author Tomasz Cisowski <t.cisowski@gmail.com>
	 * @param  int $iProductId product id
     * @return object
     */
    public function getAllAttrForProduct($iProductId)
    {
        return \Model::factory('attr')
            ->select('attr.*' )
            ->join('attr2pizza', ['attr.id', '=', 'attr2pizza.attr_id'])
			->where('attr2pizza.pizza_id', $iProductId)
            ->order_by_asc('attr.name')
            ->find_many();
    }
	
	/**
     * Get attribute by name
     *
     * @author Tomasz Cisowski <t.cisowski@gmail.com>
     * @param  string $sAttrName attribute name
     * @return object
     */
	public function getAttrByName( $sAttrName )
    {
        return \Model::factory('attr')
                    ->select('attr.*')
                    ->where('attr.name', $sAttrName)
                    ->find_one();
    }
	
	/**
     * Get all attributes for product as one lined string
     *
     * @author Tomasz Cisowski <t.cisowski@gmail.com>
	 * @param  int $iProductId product id
     * @return string
     */
	public function getAttrNameCollection($iProductId) {
		
		$aNameCollection = array();
		foreach($this->getAllAttrForProduct($iProductId) as $row) {
			$aNameCollection[] = $row->name;
		}
		return implode(', ', $aNameCollection);
	}
}
