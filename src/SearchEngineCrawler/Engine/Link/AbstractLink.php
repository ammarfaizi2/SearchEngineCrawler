<?php

namespace SearchEngineCrawler\Engine\Link;

use Zend\Dom\Query as DomQuery;
use SearchEngineCrawler\ResultSet\Link\ResultSet;

abstract class AbstractLink implements LinkInterface
{
    /**
     * @var ResultSet
     */
    protected $set;

    /**
     * @var DomQuery
     */
    protected $domQuery;

    /**
     *
     * @param string $html
     */
    public function source($html)
    {
        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($html);
        return $this;
    }

    public function append($result)
    {
        $this->getResults()->append($result);
        return $this;
    }

    /**
     * @return ResultSet
     */
    public function getResults()
    {
        if(null === $this->set) {
            $this->set = new ResultSet();
        }
        return $this->set;
    }

    /**
     * Perform an XPath query
     *
     * @param  string|array $xpathQuery
     * @param  string|null  $query      CSS selector query
     * @throws Exception\RuntimeException
     * @return NodeList
     */
    public function xpath($xpathQuery, $query = null)
    {
        return $this->getDomQuery()->queryXpath($xpathQuery, $query = null);
    }

    /**
     *
     * @return Query
     */
    public function getDomQuery()
    {
        if(null === $this->domQuery) {
            $this->setDomQuery(new DomQuery());
        }
        return $this->domQuery;
    }

    public function setDomQuery(DomQuery $domQuery)
    {
        $this->domQuery = $domQuery;
        return $this;
    }
}
