<?php
class KL_Slideshow_IndexController extends Mage_Core_Controller_Front_Action
{
    public function loadSlideshowAction()
    {
        $slideshow = Mage::getModel('slideshow/slideshow')->load($this->getRequest()->getParam('id'));

        $images = Mage::getModel('slideshow/slide')->getCollection()->addSlideshowFilter($slideshow->getId());

        $html = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'collection',
            array('template' => $slideshow->getTemplate(), 'images' => $images)
        )->toHtml();

        $this->getResponse()->setBody($html);
    }
}
