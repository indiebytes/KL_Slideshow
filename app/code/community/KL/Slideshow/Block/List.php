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
 * List block
 *
 * @category  KL
 * @package   KL_Slideshow
 * @author    Andreas Karlsson <andreas@karlssonlord.com>
 * @copyright 2013 Karlsson & Lord AB
 * @license   http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Block_List extends Mage_Core_Block_Template
{
    /**
     * Slideshow collection
     *
     * @var KL_Slideshow_Model_Mysql4_Slide_Collection
     */
    private $_slideshow;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->_slideshow = Mage::getModel('slideshow/slide')->getCollection();

        $this->addData(
            array(
                'cache_lifetime' => 600,
                'cache_tags'     => array(Mage_Catalog_Model_Product::CACHE_TAG),
            )
        );
    }

    /**
     * Get slideshow
     *
     * @return KL_Slideshow_Model_Mysql4_Slide_Collection
     */
    public function getSlideshow()
    {
        $this->_slideshow->addStoreFilter(Mage::app()->getStore()->getId());
        $this->_slideshow->addFilter('is_active', array('eq' => '1'));
        $this->_slideshow->setPageSize($this->getAntalSlideshowAttVisa());

        return $this->_slideshow;
    }
}
