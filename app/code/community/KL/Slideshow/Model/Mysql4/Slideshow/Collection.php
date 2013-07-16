<?php
/**
 * Slideshow
 *
 * LICENSE
 *
 * This source file is subject to the new MIT license that is bundled
 * with this package in the file LICENSE.
 *
 * @category   KL
 * @package    KL_Slideshow
 * @copyright  Copyright (c) 2013 Karlsson & Lord AB (http://karlssonlord.com)
 * @license    http://opensource.org/licenses/MIT MIT License
 */

/**
 * Slide collection
 *
 * @category   KL
 * @package    KL_Slideshow
 * @copyright  Copyright (c) 2013 Karlsson & Lord AB (http://karlssonlord.com)
 * @license    http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Model_Mysql4_Slideshow_Collection 
    extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('slideshow/slideshow');
        $this->_map['fields']['store'] = 'store_table.store_id';
    }

    /**
     * To option array
     *
     * @return
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray('slideshow_id', 'name');
    }

    /**
     * Add store filter
     *
     * @param mixed   $store
     * @param boolean $withAdmin
     *
     * @return KL_Slideshow_Model_Mysql4_Slide_Collection
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        if ($store instanceof Mage_Core_Model_Store) {
            $store = array($store->getId());
        }

        $scope = $withAdmin ? array(0, $store) : $store;

        $this->addFilter('store', array('in' => $scope), 'public');

        return $this;
    }

    /**
     * Get select count SQL
     *
     * @return
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(Zend_Db_Select::GROUP);

        return $countSelect;
    }

    /**
     * Render filter before
     *
     * @return
     */
    protected function _renderFiltersBefore()
    {
        if ($this->getFilter('store')) {
            $this->getSelect()->join(
                array('store_table' => $this->getTable('slideshow/slideshow_store')),
                'main_table.slideshow_id = store_table.slideshow_id',
                array()
            )->group('main_table.slideshow_id');
        }

        return parent::_renderFiltersBefore();
    }
}
