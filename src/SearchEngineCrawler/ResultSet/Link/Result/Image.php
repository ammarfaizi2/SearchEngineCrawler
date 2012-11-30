<?php

namespace SearchEngineCrawler\ResultSet\Link\Result;

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
