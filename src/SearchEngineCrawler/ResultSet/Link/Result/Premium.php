<?php

namespace SearchEngineCrawler\ResultSet\Link\Result;

use SearchEngineCrawler\ResultSet\Link\RichSnippet;

class Premium extends AbstractResult
    implements RichSnippetAwareInterface
{
    protected $anchor;

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

    public function getRichsnippet()
    {
        if(null === $this->richSnippet) {
            $this->setRichsnippet(new RichSnippet());
        }
        return $this->richSnippet;
    }

    public function setRichsnippet(RichSnippet $richSnippet)
    {
        $this->richSnippet = $richSnippet;
        return $this;
    }
}
