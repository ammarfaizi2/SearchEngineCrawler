<?php

namespace SearchEngineCrawlerTest\Crawler;

use SearchEngineCrawler\Crawler\AbstractCrawler;

class CachedCrawler extends AbstractCrawler
{
    public function crawl($engine, $keyword, array $options = array())
    {
        $lang = $options['location']['lang'];
        $cache = $lang . '.' . strtr($keyword, ' ', '.') . '.html';
        $contents = file_get_contents(__DIR__ . '/_files/' . $cache);
        return $contents;
    }
}
