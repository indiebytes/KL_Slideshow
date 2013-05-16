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
 * Admin grid
 *
 * @category   KL
 * @package    KL_Slideshow
 * @copyright  Copyright (c) 2013 Karlsson & Lord AB (http://karlssonlord.com)
 * @license    http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_Admin_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('slideshowGrid');
        $this->setDefaultSort('position');
        $this->setDefaultDir('ASC');
    }

    /**
     * Prepare collection
     *
     * @return
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slideshow/slide')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return
     */
    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('name', array(
            'header'    => Mage::helper('slideshow')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('position', array(
            'header'    => Mage::helper('slideshow')->__('Position'),
            'index'     => 'position',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('slideshow')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'
                                => array($this, '_filterStoreCondition'),
            ));
        }

        $this->addColumn('is_active', array(
            'header'    => Mage::helper('slideshow')->__('Status'),
            'index'     => 'is_active',
            'type'      => 'options',
            'options'   => array(
                0 => Mage::helper('slideshow')->__('Disabled'),
                1 => Mage::helper('slideshow')->__('Enabled')
            ),
        ));

        $this->addColumn('creation_time', array(
            'header'    => Mage::helper('slideshow')->__('Date Created'),
            'index'     => 'creation_time',
            'type'      => 'datetime',
        ));

        $this->addColumn('update_time', array(
            'header'    => Mage::helper('slideshow')->__('Last Modified'),
            'index'     => 'update_time',
            'type'      => 'datetime',
        ));

        return parent::_prepareColumns();
    }

    /**
     * After load collection
     *
     * @return void
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');

        parent::_afterLoadCollection();
    }

    /**
     * After load collection
     *
     * @return void
     */
    protected function _filterStoreCondition($collection, $column)
    {
        $value = $column->getFilter()->getValue();

        if (!$value) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }

    /**
     * Get row URL
     *
     * @return void
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('slide_id' => $row->getId()));
    }
}
