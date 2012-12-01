<?php

namespace SearchEngineCrawlerTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class WebLinksTest extends TestCase
{
    public function testCanCrawlNaturalLinks()
    {
        $crawler = new CachedCrawler();

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('zend framework', array(
            'links' => array('natural'),
            'location' => array('lang' => 'fr'),
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $naturals = $linkSet->getNaturalResults();

        $this->assertEquals(10, count($naturals));
        $this->assertEquals(10, count($linkSet));
        $this->assertEquals(4, count($naturals->offsetGet(0)->getExtension()->getSitelinks()));

        // test index
        $keys = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $this->assertEquals($keys, array_keys($linkSet->getArrayCopy()));
    }

    public function testCanCrawlNaturalImageVideoLinks()
    {
        $crawler = new CachedCrawler();

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('rooney', array(
            'links' => array('natural', 'image', 'video'),
            'location' => array('lang' => 'fr'),
        ));
        $linkSet = $set->getPage(1)->getLinks();

        $this->assertEquals(7, count($linkSet->getNaturalResults()));
        $this->assertEquals(5, count($linkSet->getImageResults()));
        $this->assertEquals(3, count($linkSet->getVideoResults()));
        $this->assertEquals(15, count($linkSet));
    }

    public function testCanCrawlNaturalProductPremiumLinks()
    {
        $crawler = new CachedCrawler();

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('table a manger', array(
            'links' => array('natural', 'product', 'premium'),
            'location' => array('lang' => 'fr'),
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $premiums = $linkSet->getPremiumResults();

        $this->assertEquals(10, count($linkSet->getNaturalResults()));
        $this->assertEquals(3, count($linkSet->getProductResults()));
        $this->assertEquals(3, count($premiums));
        $this->assertEquals(3, count($premiums->offsetGet(0)->getRichSnippet()->getProducts()));
        $this->assertEquals(16, count($linkSet));
    }

    public function testCanCrawlNaturalMapLinks()
    {
        $crawler = new CachedCrawler();

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('restaurant paris', array(
            'links' => array('natural', 'map'),
            'location' => array('lang' => 'fr'),
        ));
        $linkSet = $set->getPage(1)->getLinks();

        $this->assertEquals(10, count($linkSet->getNaturalResults()));
        $this->assertEquals(7, count($linkSet->getMapResults()));
        $this->assertEquals(17, count($linkSet));
    }

    public function testCanCrawlNaturalNewsPremiumLinks()
    {
        $crawler = new CachedCrawler();

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('bourse de paris', array(
            'links' => array('natural', 'news', 'premium'),
            'location' => array('lang' => 'fr'),
        ));
        $linkSet = $set->getPage(1)->getLinks();

        $this->assertEquals(10, count($linkSet->getNaturalResults()));
        $this->assertEquals(3, count($linkSet->getNewsResults()));
        $this->assertEquals(3, count($linkSet->getPremiumResults()));
        $this->assertEquals(16, count($linkSet));
    }
}
