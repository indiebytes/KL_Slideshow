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
 * Form block class
 *
 * @category  KL
 * @package   KL_Slideshow
 * @author    Andreas Karlsson <andreas@karlssonlord.com>
 * @copyright 2013 Karlsson & Lord AB
 * @license   http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_Adminhtml_Slide_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('slide_form');
        $this->setTitle(Mage::helper('slideshow')->__('Slide'));
    }

    /**
     * Prepare layout
     *
     * @return void
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if ( Mage::getSingleton('cms/wysiwyg_config')->isEnabled() ) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    /**
     * Prepare form
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('slideshow');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getData('action'),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $form->setHtmlIdPrefix('slide_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            array(
                'legend' => Mage::helper('slideshow')->__('Slide'),
                'class' => 'fieldset-wide'
            )
        );

        if ( $model->getSlideId() ) {
            $fieldset->addField(
                'slide_id',
                'hidden',
                array(
                    'name' => 'slide_id',
                )
            );
        }

        $fieldset->addField(
            'title',
            'text',
            array(
                'name' => 'title',
                'label' => Mage::helper('slideshow')->__('Title'),
                'title' => Mage::helper('slideshow')->__('Title'),
                'required' => true,
            )
        );

        if ( Mage::app()->isSingleStoreMode() ) {
            $fieldset->addField(
                'store_id',
                'hidden',
                array(
                    'name' => 'stores[]',
                    'value' => Mage::app()->getStore(true)->getId()
                )
            );

            $model->setStoreId(Mage::app()->getStore(true)->getId());
        } else {
            $fieldset->addField(
                'store_id',
                'multiselect',
                array(
                    'name' => 'stores[]',
                    'label' => Mage::helper('slideshow')->__('Store View'),
                    'title' => Mage::helper('slideshow')->__('Store View'),
                    'required' => true,
                    'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                )
            );
        }

        $fieldset->addField(
            'is_active',
            'select',
            array(
                'label' => Mage::helper('slideshow')->__('Status'),
                'title' => Mage::helper('slideshow')->__('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => array(
                    '1' => Mage::helper('slideshow')->__('Enabled'),
                    '0' => Mage::helper('slideshow')->__('Disabled'),
                ),
            )
        );

        if ( ! $model->getId() ) {
            $model->setData('is_active', '1');
        }

        $fieldset->addField(
            'cta',
            'text',
            array(
                'name' => 'cta',
                'label' => Mage::helper('slideshow')->__('CTA'),
                'title' => Mage::helper('slideshow')->__('CTA'),
                'after_element_html' => '<small>' . Mage::helper('slideshow')->__(
                        'The Call To Action text could e.g. be used in a button.'
                    ) . '</small>',
            )
        );

        $fieldset->addField(
            'position',
            'text',
            array(
                'name' => 'position',
                'label' => Mage::helper('slideshow')->__('Position'),
                'title' => Mage::helper('slideshow')->__('Position'),
            )
        );

        $fieldset->addType('image', 'KL_Slideshow_Model_Data_Form_Element_Image');

        $fieldset->addField(
            'filename',
            'image',
            array(
                'name' => 'filename',
                'label' => Mage::helper('slideshow')->__('Image'),
                'title' => Mage::helper('slideshow')->__('Image'),
            )
        );



        $fieldset->addField(
            'alternative_filename',
            'image',
            array(
                'name' => 'alternative_filename',
                'label' => Mage::helper('slideshow')->__('MouseOver Image'),
                'title' => Mage::helper('slideshow')->__('MouseOver Image'),
            )
        );

        $fieldset->addField(
            'url',
            'text',
            array(
                'name' => 'url',
                'label' => Mage::helper('slideshow')->__('URL'),
                'title' => Mage::helper('slideshow')->__('URL'),
            )
        );

        $fieldset->addField(
            'content',
            'editor',
            array(
                'name' => 'content',
                'label' => Mage::helper('slideshow')->__('Content'),
                'title' => Mage::helper('slideshow')->__('Content'),
                'style' => 'height:12em',
                'required' => false,
                'config' => Mage::getSingleton('cms/wysiwyg_config')->getConfig()
            )
        );

        $fieldset->addField(
            'classes',
            'text',
            array(
                'name' => 'classes',
                'label' => Mage::helper('slideshow')->__('CSS Classes'),
                'title' => Mage::helper('slideshow')->__('CSS Classes'),
            )
        );

        $fieldset->addField(
            'slideshow_id',
            'multiselect',
            array(
                'name' => 'slideshows[]',
                'label' => Mage::helper('slideshow')->__('Slideshow'),
                'title' => Mage::helper('slideshow')->__('Slideshow'),
                'required' => false,
                'values' => Mage::helper('slideshow')->getSlideshows()
            )
        );

        $fieldset->addField(
            'custom_size',
            'select',
            array(
                'label' => Mage::helper('slideshow')->__('Size'),
                'title' => Mage::helper('slideshow')->__('Size'),
                'name' => 'custom_size',
                'required' => false,
                'options' => Mage::helper('slideshow')->getConfigValueSeparatedByComma('sizes')
            )
        );

        $fieldset->addField(
            'custom_style',
            'select',
            array(
                'label' => Mage::helper('slideshow')->__('Style'),
                'title' => Mage::helper('slideshow')->__('Style'),
                'name' => 'custom_style',
                'required' => false,
                'options' => Mage::helper('slideshow')->getConfigValueSeparatedByComma('styles')
            )
        );

        $fieldset->addField(
            'custom_template',
            'select',
            array(
                'label' => Mage::helper('slideshow')->__('Template'),
                'title' => Mage::helper('slideshow')->__('Template'),
                'name' => 'custom_template',
                'required' => false,
                'options' => Mage::helper('slideshow')->getConfigValueSeparatedByComma('templates')
            )
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
