<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\ResultSet\Page;

use ArrayObject;
use SearchEngineCrawler\ResultSet\Link\ResultSet as LinkSet;
use SearchEngineCrawler\ResultSet\Metadata\ResultSet as MetadataSet;

class Container extends ArrayObject
{
    public function hasLinks()
    {
        return $this->offsetExists('links');
    }

    public function getLinks()
    {
        return $this->offsetGet('links');
    }

    public function setLinks(LinkSet $set)
    {
        $this->offsetSet('links', $set);
        return $this;
    }

    public function hasMetadatas()
    {
        return $this->offsetExists('metadata');
    }

    public function getMetadatas()
    {
        return $this->offsetGet('metadata');
    }

    public function setMetadatas(MetadataSet $set)
    {
        $this->offsetSet('metadata', $set);
        return $this;
    }
}
