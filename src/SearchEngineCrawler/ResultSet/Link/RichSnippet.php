<?php

/**
 * more information at http://www.seomoz.org/blog/a-visual-guide-to-rich-snippets
 */

namespace SearchEngineCrawler\ResultSet\Link;

use Zend\Stdlib\AbstractOptions;

class RichSnippet extends AbstractOptions
{
    protected $rating;

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }
}
