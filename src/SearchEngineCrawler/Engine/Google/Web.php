<?php

namespace SearchEngineCrawler\Engine\Google;

use SearchEngineCrawler\Engine\AbstractEngine;
use SearchEngineCrawler\ResultSet\ResultSet;

class Web extends AbstractEngine
{
    public function crawl($keyword, array $options = array())
    {
        $crawler = $this->getCrawler();
        $source = $crawler->crawl('google', $keyword, $options);
        
        $resultSet = new ResultSet();
        foreach($options['links'] as $link) {
            $link = $this->getLink($link);
            $results = $link->detect($source);
            $resultSet->merge($results);
        }
        
        $resultSet->sort();
        return $resultSet;
    }
}