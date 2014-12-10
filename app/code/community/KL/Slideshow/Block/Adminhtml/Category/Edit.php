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
 * Admin edit
 *
 * @category  KL
 * @package   KL_Slideshow
 * @author    Andreas Karlsson <andreas@karlssonlord.com>
 * @copyright 2013 Karlsson & Lord AB
 * @license   http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_Adminhtml_Category_Edit
    extends KL_Slideshow_Block_Adminhtml_Category_Form_Container
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->_objectId   = 'category_id';
        $this->_controller = 'adminhtml_category';

        parent::__construct();

        $this->_updateButton('save',   'label', Mage::helper('slideshow')->__('Save category'));
        $this->_updateButton('delete', 'label', Mage::helper('slideshow')->__('Delete category'));

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
        if (Mage::registry('slideshow_category')->getId()) {
            return Mage::helper('slideshow')->__(
                "Edit Category '%s'",
                $this->htmlEscape(Mage::registry('slideshow_category')->getTitle())
            );
        } else {
            return Mage::helper('slideshow')->__('New Category');
        }
    }
}
