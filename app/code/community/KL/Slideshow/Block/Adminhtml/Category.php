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
 * Admin block
 *
 * @category  KL
 * @package   KL_Slideshow
 * @author    Andreas Karlsson <andreas@karlssonlord.com>
 * @copyright 2013 Karlsson & Lord AB
 * @license   http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_Adminhtml_Category
    extends KL_Slideshow_Block_Adminhtml_Category_Grid_Container
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->_controller     = 'adminhtml_category';
        $this->_headerText     = Mage::helper('slideshow')->__('Categories');
        $this->_addButtonLabel = Mage::helper('slideshow')->__('Add New Category');

        parent::__construct();
    }
}
