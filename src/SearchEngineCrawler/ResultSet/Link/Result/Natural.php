<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\ResultSet\Link\Result;

use SearchEngineCrawler\ResultSet\Link\Extension;
use SearchEngineCrawler\ResultSet\Link\RichSnippet;

class Natural extends AbstractResult
    implements RichSnippetAwareInterface, ExtensionAwareInterface
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
        if(null === $this->extension) {
            $this->setExtension(new Extension());
        }
        return $this->extension;
    }

    public function setExtension(Extension $extension)
    {
        $this->extension = $extension;
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
