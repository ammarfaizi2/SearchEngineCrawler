<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Metadata;

use Zend\Dom\Query as DomQuery;

abstract class AbstractMetadata implements MetadataInterface
{
    protected $metadata;

    protected static $domQuery;

    /**
     *
     * @return Query
     */
    public function getDomQuery()
    {
        if(null === static::$domQuery) {
            $this->setDomQuery(new DomQuery());
        }
        return static::$domQuery;
    }

    public function setDomQuery(DomQuery $domQuery)
    {
        static::$domQuery = $domQuery;
        return $this;
    }

    public function getMetadata()
    {
        return $this->metadata;
    }
}
