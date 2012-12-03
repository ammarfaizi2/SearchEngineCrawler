<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace StrongCrawlLiveTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\News as GoogleNews;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class NewsTest extends TestCase
{
    protected $engine;

    protected $keyword;

    protected $links = array('news', 'image', 'natural');
    protected $metadatas = array('results');

    protected function getKeywordFileCache()
    {
        return strtr($this->keyword, ' ', '.');
    }

    public function setUp()
    {
        $this->engine = new GoogleNews();
        if(!CRAWL_IN_LIVE) {
            $crawler = new CachedCrawler();
            $crawler->setFilePattern(__DIR__ . '/sources/news/%s.html');
            $this->engine->setCrawler($crawler);
        }
    }

    public function keywordRegister($keyword)
    {
        $this->keyword = $keyword;
        $cache = __DIR__ . '/sources/news/' . $this->getKeywordFileCache() . '.html';
        if(!CRAWL_IN_LIVE && file_exists($cache)) {
            $crawler = $this->engine->getCrawler();
            $crawler->setSource(file_get_contents($cache));
        }
    }

    public function tearDown()
    {
        $cache = __DIR__ . '/sources/news/' . $this->getKeywordFileCache() . '.html';
        if(CRAWL_UPDATE_CACHE || !file_exists($cache)) {
            $crawler = $this->engine->getCrawler();
            $source = $crawler->getSource();
            file_put_contents($cache, $source);
        }
        if(CRAWL_IN_LIVE) {
            sleep(2);
        }
    }

    public function test_Rooney_Case()
    {
        $this->keywordRegister('rooney');

        $set = $this->engine->crawl($this->keyword, array(
            'links' => $this->links,
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
            'metadatas' => $this->metadatas,
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $metadatasSet = $set->getPage(1)->getMetadatas();

        // tests type of links
        $this->assertEquals(12, count($linkSet->getNewsResults()));
        $this->assertEquals(7, count($linkSet->getImageResults()));
        $this->assertEquals(1, count($linkSet->getNaturalResults()));
        $this->assertEquals(20, count($linkSet));

        // tests details
        $this->assertEquals('France Football', $linkSet->getNewsResults()->offsetGet(0)->getSource());
        $this->assertEquals('DirectMatin.fr', $linkSet->getNewsResults()->offsetGet(1)->getSource());
        $this->assertEquals('Le Point', $linkSet->getNewsResults()->offsetGet(2)->getSource());
        $this->assertEquals('Pure People', $linkSet->getNewsResults()->offsetGet(3)->getSource());
        $this->assertEquals('29 nov. 2012', $linkSet->getNewsResults()->offsetGet(3)->getDate());
        $this->assertEquals('http://news.google.fr/news/tbn/Bu0RfPKGOoUJ/6.jpg', $linkSet->getNewsResults()->offsetGet(3)->getImage());
        
        // tests metadatas
        $this->assertEquals(70100, (integer)$metadatasSet->getResults());
    }
}
