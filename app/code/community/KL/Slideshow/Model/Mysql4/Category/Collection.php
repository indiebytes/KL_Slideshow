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
 * Slide collection
 *
 * @category   KL
 * @package    KL_Slideshow
 * @copyright  Copyright (c) 2013 Karlsson & Lord AB (http://karlssonlord.com)
 * @license    http://opensource.org/licenses/MIT MIT License
 */
class KL_Slideshow_Model_Mysql4_Category_Collection
    extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('slideshow/category');
    }

    /**
     * To option array
     *
     * @return
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray('category_id', 'name');
    }
}
