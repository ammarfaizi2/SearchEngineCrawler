<?php

namespace SearchEngineCrawler\ResultSet\Link\Result;

class News extends AbstractResult
{
    protected $anchor;

    public function getAnchor()
    {
        return $this->anchor;
    }

    public function setAnchor($anchor)
    {
        $this->anchor = $anchor;
        return $this;
    }
}
