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
    /**
    * Z-index doesnt work on Youtube videos in IE. this function adds a parameter to the URL to fix that.
    */
    public function MakeYoutubeWorkWithIE($content)
    {

        // The Regular Expression filter
        $reg_exUrl = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/[^\"\']*)?/";

        // Check if there is a url in the text
        if(preg_match($reg_exUrl, $content, $url)) {

                $oldUrl = $url[0];

                // check if we haven't already set wmode
                if (strpos($oldUrl,'wmode') !== false) {
                    return $content;
                }

                else{
                    // Returns a string if the URL has parameters or NULL if not
                    $query = parse_url($oldUrl, PHP_URL_QUERY);
                    $separator = $query ? "&" : "?";
                    $newUrl = $oldUrl .  $separator . "wmode=transparent";
                    return preg_replace($reg_exUrl, $newUrl, $content);
                }
        } else {

               // if no urls in the text just return the text
               return $content;
        };
    }
}
