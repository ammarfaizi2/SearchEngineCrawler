<?php

namespace SearchEngineCrawler\Engine\Link;

use Zend\Dom\Query as DomQuery;

abstract class AbstractLink implements LinkInterface
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