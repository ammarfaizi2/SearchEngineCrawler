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

    protected $domQuery;

    /**
     *
     * @param string $html
     */
    public function source(&$html)
    {
        // init metadata
        $this->metadata = null;

        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->strictErrorChecking = false;
        @$dom->loadHTML($html);
        $dom->formatOutput = true;
        $html = $dom->saveHTML();

        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($html);
        return $this;
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
        return $this->getDomQuery()->queryXpath($xpathQuery, $query);
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

    public function getMetadata()
    {
        return $this->metadata;
    }
}
