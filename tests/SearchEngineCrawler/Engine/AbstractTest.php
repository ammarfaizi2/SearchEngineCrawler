<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

abstract class AbstractTest extends TestCase
{
    protected $engine; // must be override

    protected $keyword;

    protected $links; // must be override
    protected $metadatas; // must be override
    protected $cachePattern; // must be override

    protected function getKeywordFileCache()
    {
        return strtr($this->keyword, ' ', '.');
    }

    public function setUp()
    {
        if(!CRAWL_IN_LIVE) {
            $crawler = new CachedCrawler();
            $crawler->setFilePattern($this->cachePattern);
            $this->engine->setCrawler($crawler);
        }
    }

    public function keywordRegister($keyword)
    {
        $this->keyword = $keyword;
        $cache = sprintf($this->cachePattern, $this->getKeywordFileCache());
        if(!CRAWL_IN_LIVE && file_exists($cache)) {
            $crawler = $this->engine->getCrawler();
            $crawler->setSource(file_get_contents($cache));
        }
    }

    public function tearDown()
    {
        $cache = sprintf($this->cachePattern, $this->getKeywordFileCache());
        if(CRAWL_UPDATE_CACHE || !file_exists($cache)) {
            $crawler = $this->engine->getCrawler();
            $source = $crawler->getSource();
            file_put_contents($cache, $source);
        }
        if(CRAWL_IN_LIVE) {
            sleep(2);
        }
    }
}
