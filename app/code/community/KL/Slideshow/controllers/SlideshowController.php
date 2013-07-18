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
class KL_Slideshow_SlideshowController extends Mage_Adminhtml_Controller_Action
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
        $id    = $this->getRequest()->getParam('slideshow_id');
        $model = Mage::getModel('slideshow/slideshow');

        if ($id) {
            $model->load($id);

            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('slideshow')->__("This slideshow doesn't exist anymore.")
                );

                $this->_redirect('*/*/');

                return;
            }

            $title      = $model->getName();
            $breadcrumb = Mage::helper('slideshow')->__('Edit Slideshow');
        } else {
            $title      = $this->__('New Slideshow');
            $breadcrumb = Mage::helper('slideshow')->__('New Slideshow');
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
            $id    = $this->getRequest()->getParam('slideshow_id');
            $model = Mage::getModel('slideshow/slideshow')->load($id);

            if (!$model->getId() && $id) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('slideshow')->__("This slideshow doesn't exist anymore.")
                );

                $this->_redirect('*/*/');

                return;
            }

            try {
                $model->setData($data);
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('slideshow')->__('The slideshow was successfully saved.')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('slideshow_id' => $model->getId()));

                    return;
                }
            } catch (Exception $e) {
                $error_msg = $e->getMessage();

                Mage::getSingleton('adminhtml/session')->addError($error_msg);
                Mage::getSingleton('adminhtml/session')->setFormData($data);

                $this->_redirect(
                    '*/*/edit',
                    array('slideshow_id' => $this->getRequest()->getParam('slideshow_id'))
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
        $id = $this->getRequest()->getParam('slideshow_id');

        if ($id) {
            try {
                $model = Mage::getModel('slideshow/slideshow');

                $model->load($id);
                $model->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('slideshow')->__('The slideshow was successfully deleted.')
                );

                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());

                $this->_redirect('*/*/edit', array('slideshow_id' => $id));

                return;
            }
        }

        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('slideshow')->__('Could not find the slideshow.')
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