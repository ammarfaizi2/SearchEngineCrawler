<?php

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
