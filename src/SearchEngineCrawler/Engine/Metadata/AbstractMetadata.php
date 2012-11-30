<?php

namespace SearchEngineCrawler\Engine\Metadata;

use Zend\Dom\Query as DomQuery;

abstract class AbstractMetadata implements MetadataInterface
{
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
}
