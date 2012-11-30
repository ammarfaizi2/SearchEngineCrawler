<?php

namespace SearchEngineCrawler\ResultSet\Link\Result;

use SearchEngineCrawler\ResultSet\Link\Extension;
use SearchEngineCrawler\ResultSet\Link\RichSnippet;

class Natural extends AbstractResult
{
    protected $anchor;

    protected $extension;
    
    protected $richSnippet;
    
    public function getAnchor()
    {
        return $this->anchor;
    }

    public function setAnchor($anchor)
    {
        $this->anchor = $anchor;
        return $this;
    }
    
    public function getExtension()
    {
        return $this->extension;
    }
    
    public function setExtension(Extension $extension)
    {
        $this->extension = $extension;
        return $this;
    }
    
    public function getRichSnippet()
    {
        return $this->richSnippet;
    }
    
    public function setRichSnippet(RichSnippet $richSnippet)
    {
        $this->richSnippet = $richSnippet;
        return $this;
    }
}
