<?php

namespace SearchEngineCrawler\ResultSet\Result;

use SearchEngineCrawler\ResultSet\AbstractResult;

class Video extends AbstractResult
{
    protected $anchor;
    
    protected $image;
    
    public function getAnchor()
    {
        return $this->anchor;
    }

    public function setAnchor($anchor)
    {
        $this->anchor = $anchor;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }
}
