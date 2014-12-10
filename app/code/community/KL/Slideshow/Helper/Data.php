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
class KL_Slideshow_Helper_Data extends Mage_Core_Helper_Abstract {
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

        if ( $filename !== null ) {
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
        foreach ($model->getCollection()->load() as $_slideshow) {
            $data[] = array(
                'label' => $_slideshow->getTitle(),
                'value' => $_slideshow->getSlideshowId()
            );
        }

        return $data;
    }

    /**
     * Get Categories for multiselect in form
     *
     * @return array
     */
    public function getCategories()
    {
        $model = Mage::getModel('slideshow/category');

        $data = array();
        foreach ($model->getCollection()->load() as $_category) {
            $data[] = array(
                'label' => $_category->getName(),
                'value' => $_category->getCategoryId()
            );
        }

        return $data;
    }

    /**
     * Return data specified as a comma separated string as an associative array
     *
     * @param $name
     *
     * @return array
     */
    public function getConfigValueSeparatedByComma($name)
    {
        $value = Mage::getStoreConfig('kl_slideshow/kl_slideshow_settings/' . $name);
        $value = explode(",", $value);
        $return = array();
        foreach ($value as $name) {
            $return[$name] = $this->__($name);
        }
        return $return;
    }
}
