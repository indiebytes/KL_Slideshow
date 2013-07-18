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
 * Data helper
 *
 * @category   KL
 * @package    KL_Slideshow
 * @copyright  Copyright (c) 2013 Karlsson & Lord AB (http://karlssonlord.com)
 * @license    http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Get image path
     *
     * @return string
     */
    public function getImagePath()
    {
        $path = Mage::getBaseDir('media') . DS . 'slideshow' . DS;

        return $path;
    }

    /**
     * Get image URL
     *
     * @return string
     */
    public function getImageUrl($filename = null)
    {
        $url = Mage::getBaseUrl('media') . 'slideshow' . DS;

        if ($filename !== null) {
            $url .= $filename;
        }

        return $url;
    }

    /**
     * Get Slideshows for multiselect in form
     *
     * @return array
     */
    public function getSlideshows()
    {
        $model = Mage::getModel('slideshow/slideshow');

        $data = array();
        foreach($model->getCollection()->load() as $_slideshow) {
            $data[] = array(
                'label' => $_slideshow->getTitle(),
                'value' => $_slideshow->getSlideshowId()
            );
        }

        return $data;
    }
}
