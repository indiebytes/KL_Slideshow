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
 * Slideshow block
 *
 * @category   KL
 * @package    KL_Slideshow
 * @copyright  Copyright (c) 2013 Karlsson & Lord AB (http://karlssonlord.com)
 * @license    http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_Slideshow extends Mage_Core_Block_Template
{
    /**
     * Get images
     *
     * @return KL_Slideshow_Model_Mysql4_Slide_Collection
     */
    public function getImages()
    {
        return Mage::getModel('slideshow/slide')
            ->getCollection()
            ->addStoreFilter(Mage::app()->getStore()->getId())
            ->addFilter('is_active', array('eq' => '1'))
            ->setOrder('position', 'ASC');
    }
}
