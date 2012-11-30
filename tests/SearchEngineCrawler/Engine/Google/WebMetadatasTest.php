<?php

namespace SearchEngineCrawlerTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class WebMetadatasTest extends TestCase
{
    public function testCanCrawlResultMetadata()
    {
        $crawler = new CachedCrawler();

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('zend framework', array(
            'links' => array('natural'),
            'metadatas' => array('results'),
            'location' => array('lang' => 'fr'),
        ));
        $metadatasSet = $set->getPage(1)->getMetadatas();
        $this->assertEquals(5970000, (integer)$metadatasSet->getResults());
    }

    public function testCanCrawlWordspellingMetadata()
    {
        $crawler = new CachedCrawler();

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('talbe a manger', array(
            'links' => array('natural'),
            'metadatas' => array('word_spelling'),
            'location' => array('lang' => 'fr'),
        ));
        $metadatasSet = $set->getPage(1)->getMetadatas();
        $this->assertEquals('table a manger', $metadatasSet->getWordSpelling());
    }

    public function testCanCrawlSuggestMetadata()
    {
        $crawler = new CachedCrawler();

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('zend framework', array(
            'links' => array('natural'),
            'metadatas' => array('suggest'),
            'location' => array('lang' => 'fr'),
        ));
        $metadatasSet = $set->getPage(1)->getMetadatas();
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
    }
}
