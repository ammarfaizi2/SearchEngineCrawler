<?php

namespace SearchEngineCrawler\ResultSet\Result;

use SearchEngineCrawler\ResultSet\AbstractResult;

class Image extends AbstractResult
{
    protected $image;

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
