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
 * Admin edit
 *
 * @category   KL
 * @package    KL_Slideshow
 * @copyright  Copyright (c) 2013 Karlsson & Lord AB (http://karlssonlord.com)
 * @license    http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_Admin_Edit
    extends KL_Slideshow_Block_Admin_Form_Container
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->_objectId   = 'slide_id';
        $this->_controller = 'admin';

        parent::__construct();

        $this->_updateButton('save',   'label', Mage::helper('slideshow')->__('Save slide'));
        $this->_updateButton('delete', 'label', Mage::helper('slideshow')->__('Delete slide'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "function saveAndContinueEdit() {
             editForm.submit($('edit_form').action+'back/edit/'); }";
    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('slideshow')->getId()) {
            return Mage::helper('slideshow')->__(
                "Edit slide '%s'",
                $this->htmlEscape(Mage::registry('slideshow')->getName())
            );
        } else {
            return Mage::helper('slideshow')->__('New slide');
        }
    }
}
