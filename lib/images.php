<?php

/**
 * Get images from content and prepare to save in articles
 */
class Images {

    /**
     * Articles content
     * @var string
     */
    private $_content;

    /**
     * Storage to keep images
     * @var object Storage
     */
    private $_storage;

    /**
     * images from content
     * @var array
     */
    private $_images_from_content = array();

    /**
     * Prepare get images
     * @param Strage $storage
     * @param string $article_content
     */
    public function __construct(Storage $storage, $article_content)
    {
        $this->_storage = $storage;
        $this->_content = $content;
        $this->_images_from_content = $this->_get_images_from_content($content);
    }

    /**
     * get images from url
     * @param string $content
     * @return array images hashtable
     */
    private function _get_images_from_content($content)
    {
        $result = array();
        preg_match_all('/src=\"([a-zA-Z0-9\.\/\-\_\?\+\%\~\&\;\=\:]+)\"/i', $content, $result);

        return $result[1];
    }

    /**
     * Start conversion
     * @return string converted content
     */
    public function convert()
    {
        foreach ( $this->_images_from_content as $n => $image )
        {

        }

        return $this->_content;
    }

    /**
     * Resize image
     * @param int $new_width max width
     * @param int $new_height max height
     */
    private function _resize($new_width, $new_height)
    {
        
    }

    /**
     * Resize image
     * @return string image path
     */
    private function _get_image($url)
    {
        $image_data = @file_get_contents($url);

        if ( $image_data !== false )
        {
            $image_prefix_name = (string) self::$img_count;
        }
    }

}