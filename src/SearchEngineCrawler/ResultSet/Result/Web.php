<?php

namespace SearchEngineCrawler\ResultSet\Result;

use SearchEngineCrawler\ResultSet\AbstractResult;

class Web extends AbstractResult
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
