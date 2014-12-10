<?php
/**
 * Slideshow
 *
 * LICENSE
 *
 * This source file is subject to the new MIT license that is bundled
 * with this package in the file LICENSE.
 *
 * @category  KL
 * @package   KL_Slideshow
 * @author    Andreas Karlsson <andreas@karlssonlord.com>
 * @copyright 2013 Karlsson & Lord AB
 * @license   http://opensource.org/licenses/MIT MIT License
 */

/**
 * Admin grid
 *
 * @category  KL
 * @package   KL_Slideshow
 * @author    Andreas Karlsson <andreas@karlssonlord.com>
 * @copyright 2013 Karlsson & Lord AB
 * @license   http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_Adminhtml_Category_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('categoryGrid');
        $this->setDefaultSort('name');
        $this->setDefaultDir('ASC');
    }

    /**
     * Prepare collection
     *
     * @return
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slideshow/category')->getCollection();
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
        return $this->getUrl('*/*/edit', array('category_id' => $row->getId()));
    }
}
