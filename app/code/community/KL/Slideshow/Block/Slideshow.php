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
 * Slideshow block
 *
 * @category  KL
 * @package   KL_Slideshow
 * @author    Andreas Karlsson <andreas@karlssonlord.com>
 * @copyright 2013 Karlsson & Lord AB
 * @license   http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_Slideshow extends Mage_Core_Block_Template
{
    /**
     * Allow block to be cached for 1 hour
     */
    protected function _construct()
    {
        $this->setCacheLifetime(3600);
    }

    /**
     * Get images
     *
     * @return KL_Slideshow_Model_Mysql4_Slide_Collection
     */
    public function getImages()
    {
        $model = Mage::getModel('slideshow/slide')->getCollection();

        if ($this->getSlideshow()) {
            $model->getSelect()
                ->join(
                    array('slideshow_slide' => $model->getTable('slideshow/slideshow_slide')),
                    'main_table.slide_id = slideshow_slide.slide_id',
                    array('slideshow_slide.*')
                )
                ->where('slideshow_slide.slideshow_id = ?', $this->getSlideshow());
        }

        $model->addStoreFilter(Mage::app()->getStore()->getId())
            ->addFilter('is_active', array('eq' => '1'))
            ->setOrder('position', 'ASC');

        return $model->load();
    }
}
