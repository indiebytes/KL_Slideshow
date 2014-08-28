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
 * Slide
 *
 * @category   KL
 * @package    KL_Slideshow
 * @copyright  Copyright (c) 2013 Karlsson & Lord AB (http://karlssonlord.com)
 * @license    http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Model_Slideshow extends Mage_Core_Model_Abstract
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('slideshow/slideshow');
    }

    /**
     * Gets the first item from the current Slideshow. Current store is is used for filtering.
     *
     * @return KL_Slideshow_Model_Slide
     */
    public function getFirstSlide() {
        $model = Mage::getModel('slideshow/slide')->getCollection();

        $model->getSelect()
            ->join(
                array('slideshow_slide' => $model->getTable('slideshow/slideshow_slide')),
                'main_table.slide_id = slideshow_slide.slide_id',
                array('slideshow_slide.*')
            )
            ->where('slideshow_slide.slideshow_id = ?', $this->getId());

        return $model->addStoreFilter(Mage::app()->getStore()->getId())
            ->addFilter('is_active', array('eq' => '1'))
            ->setOrder('position', 'ASC')
            ->setPageSize(1)
            ->load()
            ->getFirstItem();
    }
}
