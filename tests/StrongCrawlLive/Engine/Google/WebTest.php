<?php

namespace StrongCrawlLiveTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;

class WebTest extends TestCase
{
    public function test_Rooney_Case()
    {
        $google = new GoogleWeb();
        $set = $google->crawl('rooney', array(
            'links' => array('natural', 'image', 'map', 'news', 'premium', 'product', 'video'),
            'location' => array('lang' => 'fr'),
        ));
        $linkSet = $set->getPage(1)->getLinks();
        
        $this->assertEquals(10, count($linkSet));
        $this->assertEquals(10, count($linkSet->getNaturalResults()));
        $this->assertEquals(5, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(0, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(3, count($linkSet->getVideoResults()));
    }
}
