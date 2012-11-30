<?php

namespace SearchEngineCrawler\Engine\Google;

use SearchEngineCrawler\Engine\AbstractEngine;
use SearchEngineCrawler\ResultSet\ResultSet;
use SearchEngineCrawler\ResultSet\Link\ResultSet as LinkSet;
use SearchEngineCrawler\ResultSet\Page\Container as PageContainer;

class Web extends AbstractEngine
{
    public function crawl($keyword, array $options = array())
    {
        $set = new ResultSet();
        $crawler = $this->getCrawler();

        $page = 1;
        $source = $crawler->crawl('google', $keyword, $options);

        // create container
        $linkSet = new LinkSet();
        $pageContainer = new PageContainer();

        // get links
        foreach($options['links'] as $link) {
            $link = $this->getLink($link);
            $results = $link->detect($source);
            $linkSet->merge($results);
        }
        $linkSet->sort();
        $pageContainer->setLinks($linkSet);

        // get metadatas
        // ...

        $set->setPage($page, $pageContainer);
        return $set;
    }
}
