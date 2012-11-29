<?php

namespace SearchEngineCrawlerTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class WebTest extends TestCase
{
    public function testCanCrawlNaturalLinks()
    {
        $crawler = new CachedCrawler();

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $resultsSet = $google->crawl('zend framework', array(
            'links' => array('natural'),
            'localisation' => array('lang' => 'fr'),
        ));
        $this->assertEquals(10, count($resultsSet));
        $keys = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $this->assertEquals($keys, array_keys($resultsSet->getArrayCopy()));
    }

    public function testCanCrawlNaturalImageVideoLinks()
    {
        $crawler = new CachedCrawler();

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $resultsSet = $google->crawl('zend framework', array(
            'links' => array('natural', 'image', 'video'),
            'localisation' => array('lang' => 'fr'),
        ));
        $this->assertEquals(14, count($resultsSet));
        $keys = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);
        $this->assertEquals($keys, array_keys($resultsSet->getArrayCopy()));
    }
}