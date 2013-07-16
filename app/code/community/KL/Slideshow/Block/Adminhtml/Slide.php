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
 * Admin block
 *
 * @category   KL
 * @package    KL_Slideshow
 * @copyright  Copyright (c) 2013 Karlsson & Lord AB (http://karlssonlord.com)
 * @license    http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_Adminhtml_Slide
    extends KL_Slideshow_Block_Adminhtml_Slide_Grid_Container
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->_controller     = 'adminhtml_slide';
        $this->_headerText     = Mage::helper('slideshow')->__('Slides');
        $this->_addButtonLabel = Mage::helper('slideshow')->__('Add new slide');

        parent::__construct();
    }
}
