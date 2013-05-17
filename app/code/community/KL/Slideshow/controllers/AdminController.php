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
 * Admin controller
 *
 * @category   KL
 * @package    KL_Slideshow
 * @copyright  Copyright (c) 2013 Karlsson & Lord AB (http://karlssonlord.com)
 * @license    http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_AdminController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Init action
     *
     * @return KL_Slideshow_AdminController
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('cms/slideshow')
            ->_addBreadcrumb(
                Mage::helper('slideshow')->__('CMS'),
                Mage::helper('slideshow')->__('CMS')
            )
            ->_addBreadcrumb(
                Mage::helper('slideshow')->__('Slideshows'),
                Mage::helper('slideshow')->__('Slideshows')
            );

        return $this;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function indexAction()
    {
        $this->_title($this->__('CMS'))->_title($this->__('Slideshows'));
        $this->_initAction();
        $this->renderLayout();
    }

    /**
     * New action
     *
     * @return void
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit action
     *
     * @return void
     */
    public function editAction()
    {
        $this->_title($this->__('CMS'))->_title($this->__('Slideshows'));

        $id    = $this->getRequest()->getParam('slide_id');
        $model = Mage::getModel('slideshow/slide');

        if ($id) {
            $model->load($id);

            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('slideshow')->__("This slide doesn't exist anymore.")
                );

                $this->_redirect('*/*/');

                return;
            }

            $title      = $model->getName();
            $breadcrumb = Mage::helper('slideshow')->__('Edit slide');
        } else {
            $title      = $this->__('New slide');
            $breadcrumb = Mage::helper('slideshow')->__('New slide');
        }

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('slideshow', $model);

        $this->_title($title);

        $this->_initAction()
            ->_addBreadcrumb($breadcrumb, $breadcrumb)
            ->renderLayout();
    }

    /**
     * Save action
     *
     * @return void
     */
    public function saveAction()
    {
        $data = $this->getRequest()->getPost();

        if ($data) {
            $id    = $this->getRequest()->getParam('slide_id');
            $model = Mage::getModel('slideshow/slide')->load($id);

            if (!$model->getId() && $id) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('slideshow')->__("This slide doesn't exist anymore.")
                );

                $this->_redirect('*/*/');

                return;
            }

            try {
                $image = $this->getRequest()->getPost('filename');

                if (!empty($_FILES['filename']['name'])) {
                    $uploader = new Varien_File_Uploader('filename');

                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);
                    
                    $result = $uploader->save(
                        Mage::helper('slideshow')->getImagePath(),
                        $_FILES['filename']['name']
                    );

                    $data['filename'] = $result['file'];
                } else if (is_array($image)) {
                    if (isset($image['delete']) && $image['delete'] == 1) {
                        $data['filename'] = '';
                    } else if (isset($image['value'])) {
                        $data['filename'] = $image['value'];
                    }
                }

                $model->setData($data);
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('slideshow')->__('The slide was successfully saved.')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('slide_id' => $model->getId()));

                    return;
                }
            } catch (Exception $e) {
                $error_msg = $e->getMessage();
                
                if ($error_msg === 'Disallowed file type.') {
                    $error_msg = Mage::helper('slideshow')
                        ->__('The image file must be in either jpeg, gif or png format.');
                }

                Mage::getSingleton('adminhtml/session')->addError($error_msg);
                Mage::getSingleton('adminhtml/session')->setFormData($data);

                $this->_redirect(
                    '*/*/edit',
                    array('slide_id' => $this->getRequest()->getParam('slide_id'))
                );

                return;
            }
        }

        $this->_redirect('*/*/');
    }

    /**
     * Delete action
     *
     * @return void
     */
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('slide_id');

        if ($id) {
            try {
                $model = Mage::getModel('slideshow/slide');

                $model->load($id);
                $model->delete();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('slideshow')->__('The slide was successfully deleted.')
                );
                
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());

                $this->_redirect('*/*/edit', array('slide_id' => $id));

                return;
            }
        }
        
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('slideshow')->__('Could not find the slide.')
        );

        $this->_redirect('*/*/');
    }

    /**
     * Is allowed
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/slideshow');
    }
}
