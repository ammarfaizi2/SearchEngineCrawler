<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\ResultSet\Page;

use ArrayObject;
use SearchEngineCrawler\ResultSet\Link\ResultSet as LinkSet;
use SearchEngineCrawler\ResultSet\Metadata\ResultSet as MetadataSet;
use Zend\Stdlib\Exception\LogicException;

class Container extends ArrayObject
{
    public function __construct($page, array $array = array())
    {
        $page = (integer)$page;
        if($page < 1) {
            throw new LogicException(
                sprintf('Page num "%s" is not valid', $page)
            );
        }
        $array = array_merge($array, array('num' => $page));
        parent::__construct($array);
    }

    /**
     * Get the num of page result
     * @return integer
     */
    public function getNum()
    {
        return $this->offsetGet('num');
    }

    public function hasLinks()
    {
        return $this->offsetExists('links');
    }

    /**
     * Get the set of links
     * @return LinkSet
     */
    public function getLinks()
    {
        return $this->offsetGet('links');
    }

    /**
     * Set the set of links
     * @param LinkSet $set
     * @return Container
     */
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
