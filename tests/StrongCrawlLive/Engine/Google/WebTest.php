<?php

namespace StrongCrawlLiveTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;

class WebTest extends TestCase
{
    protected $engine;
    
    protected $keyword;
    
    protected function getKeywordFileCache()
    {
        return strtr($this->keyword, ' ', '.');
    }
    
    public function setUp()
    {
        $this->engine = new GoogleWeb();
    }
    
    public function keywordRegister($keyword)
    {
        $this->keyword = $keyword;
        $cache = __DIR__ . '/sources/' . $this->getKeywordFileCache() . '.html';
        if(!CRAWL_IN_LIVE && file_exists($cache)) {
            $crawler = $this->engine->getCrawler();
            $crawler->setSource(file_get_contents($cache));
        }
    }
    
    public function tearDown()
    {
        $cache = __DIR__ . '/sources/' . $this->getKeywordFileCache() . '.html';
        if(CRAWL_UPDATE_CACHE || !file_exists($cache)) {
            $crawler = $this->engine->getCrawler();
            $source = $crawler->getSource();
            file_put_contents($cache, $source);
        }
        sleep(2);
    }
    
    public function test_Rooney_Case()
    {
        $this->keywordRegister('rooney');
        
        $set = $this->engine->crawl($this->keyword, array(
            'links' => array('natural', 'image', 'map', 'news', 'premium', 'product', 'video'),
            'location' => array('lang' => 'fr'),
        ));
        $linkSet = $set->getPage(1)->getLinks();
        
        $this->assertEquals(14, count($linkSet));
        $this->assertEquals(8, count($linkSet->getNaturalResults()));
        $this->assertEquals(4, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(0, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(2, count($linkSet->getVideoResults()));
    }
}
