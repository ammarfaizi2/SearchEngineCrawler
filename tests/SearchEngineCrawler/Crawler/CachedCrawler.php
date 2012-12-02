<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Crawler;

use SearchEngineCrawler\Crawler\AbstractCrawler;

class CachedCrawler extends AbstractCrawler
{
    public function crawl($engine, $keyword, array $options = array())
    {
        $lang = $options['location']['lang'];
        $cache = $lang . '.' . strtr($keyword, ' ', '.') . '.html';
        $contents = file_get_contents(__DIR__ . '/_files/' . $cache);

        $this->setSource($contents);
        return $this;
    }
}
