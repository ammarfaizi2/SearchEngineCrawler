<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace StrongCrawlLiveTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;

class WebTest extends TestCase
{
    protected $engine;
    
    protected $keyword;
    
    protected $links = array('natural', 'image', 'map', 'news', 'premium', 'premium_bottom', 'product', 'video');
    protected $metadats = array('suggest', 'word_spelling');
    
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
        $cache = __DIR__ . '/sources/web/' . $this->getKeywordFileCache() . '.html';
        if(!CRAWL_IN_LIVE && file_exists($cache)) {
            $crawler = $this->engine->getCrawler();
            $crawler->setSource(file_get_contents($cache));
        }
    }
    
    public function tearDown()
    {
        $cache = __DIR__ . '/sources/web/' . $this->getKeywordFileCache() . '.html';
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
            'links' => $this->links,
            'location' => array('lang' => 'fr'),
            'metadatas' => $this->metadats,
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $metadatasSet = $set->getPage(1)->getMetadatas();
        
        // tests type of links
        $this->assertEquals(8, count($linkSet->getNaturalResults()));
        $this->assertEquals(4, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(0, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(2, count($linkSet->getVideoResults()));
        $this->assertEquals(14, count($linkSet));
        
        // tests extension
        $this->assertEquals(4, count($linkSet->getNaturalResults()->offsetGet(0)->getExtension()->getSitelinks()));
        
        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }
    
    public function test_RestaurantParis_Case()
    {
        $this->keywordRegister('restaurant paris');
        
        $set = $this->engine->crawl($this->keyword, array(
            'links' => $this->links,
            'location' => array('lang' => 'fr'),
            'metadatas' => $this->metadats,
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $metadatasSet = $set->getPage(1)->getMetadatas();
        
        // tests type of links
        $this->assertEquals(10, count($linkSet->getNaturalResults()));
        $this->assertEquals(0, count($linkSet->getImageResults()));
        $this->assertEquals(7, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(3, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(0, count($linkSet->getVideoResults()));
        $this->assertEquals(20, count($linkSet));
        
        // tests extension
        $this->assertEquals(2, count($linkSet->getPremiumResults()->offsetGet(1)->getExtension()->getSitelinks()));
        // premium 3 has rating
        
        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }
    
    public function test_BourseParis_Case()
    {
        $this->keywordRegister('bourse paris');
        
        $set = $this->engine->crawl($this->keyword, array(
            'links' => $this->links,
            'location' => array('lang' => 'fr'),
            'metadatas' => $this->metadats,
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $metadatasSet = $set->getPage(1)->getMetadatas();
        
        // tests type of links
        $this->assertEquals(10, count($linkSet->getNaturalResults()));
        $this->assertEquals(0, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(3, count($linkSet->getNewsResults()));
        $this->assertEquals(3, count($linkSet->getPremiumResults()));
        $this->assertEquals(3, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(0, count($linkSet->getVideoResults()));
        $this->assertEquals(19, count($linkSet));
        
        // tests extension
        $this->assertEquals(4, count($linkSet->getNaturalResults()->offsetGet(1)->getExtension()->getSitelinks()));
        $this->assertEquals(2, count($linkSet->getNaturalResults()->offsetGet(2)->getExtension()->getSitelinks()));
        $this->assertEquals(4, count($linkSet->getNaturalResults()->offsetGet(3)->getExtension()->getSitelinks()));
        $this->assertEquals(2, count($linkSet->getPremiumBottomResults()->offsetGet(1)->getExtension()->getSitelinks()));
        
        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }
    
    public function test_LadyGaga_Case()
    {
        $this->keywordRegister('lady gaga');
        
        $set = $this->engine->crawl($this->keyword, array(
            'links' => $this->links,
            'location' => array('lang' => 'fr'),
            'metadatas' => $this->metadats,
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $metadatasSet = $set->getPage(1)->getMetadatas();
        
        // tests type of links
        $this->assertEquals(7, count($linkSet->getNaturalResults()));
        $this->assertEquals(5, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(3, count($linkSet->getNewsResults()));
        $this->assertEquals(0, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(3, count($linkSet->getVideoResults()));
        $this->assertEquals(18, count($linkSet));
        
        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }
    
    public function test_LadyGga_Case()
    {
        $this->keywordRegister('lady gga');
        
        $set = $this->engine->crawl($this->keyword, array(
            'links' => $this->links,
            'location' => array('lang' => 'fr'),
            'metadatas' => $this->metadats,
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $metadatasSet = $set->getPage(1)->getMetadatas();
        
        // tests type of links
        $this->assertEquals(7, count($linkSet->getNaturalResults()));
        $this->assertEquals(0, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(3, count($linkSet->getNewsResults()));
        $this->assertEquals(0, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(3, count($linkSet->getVideoResults()));
        $this->assertEquals(13, count($linkSet));
        
        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals('lady gaga', strtolower($metadatasSet->getWordSpelling()));
    }
    
    public function test_MobilierDeSalon_Case()
    {
        $this->keywordRegister('mobilier de salon');
        
        $set = $this->engine->crawl($this->keyword, array(
            'links' => $this->links,
            'location' => array('lang' => 'fr'),
            'metadatas' => $this->metadats,
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $metadatasSet = $set->getPage(1)->getMetadatas();
        
        // tests type of links
        $this->assertEquals(9, count($linkSet->getNaturalResults()));
        $this->assertEquals(4, count($linkSet->getImageResults()));
        $this->assertEquals(4, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(3, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(3, count($linkSet->getProductResults()));
        $this->assertEquals(0, count($linkSet->getVideoResults()));
        $this->assertEquals(23, count($linkSet));
        
        // tests extension
        $this->assertEquals(4, count($linkSet->getPremiumResults()->offsetGet(0)->getExtension()->getSitelinks()));
        // premium 1 & 3 has rating
        
        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }
}
