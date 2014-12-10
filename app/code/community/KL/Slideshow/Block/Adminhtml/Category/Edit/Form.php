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
 * Form block class.
 *
 * @category  KL
 * @package   KL_Slideshow
 * @author    Andreas Karlsson <andreas@karlssonlord.com>
 * @copyright 2013 Karlsson & Lord AB
 * @license   http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_Adminhtml_Category_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('category_form');
        $this->setTitle(Mage::helper('slideshow')->__('Category'));
    }

    /**
     * Prepare form
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('slideshow_category');

        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getData('action'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $form->setHtmlIdPrefix('category_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('slideshow')->__('Slideshow'),
            'class'  => 'fieldset-wide'
        ));

        if ($model->getCategoryId()) {
            $fieldset->addField('category_id', 'hidden', array(
                'name' => 'category_id',
            ));
        }

        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('slideshow')->__('Name'),
            'title'     => Mage::helper('slideshow')->__('Name'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
