<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace StrongCrawlLiveTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Image as GoogleImage;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class ImageTest extends TestCase
{
    protected $engine;

    protected $keyword;

    protected $links = array('image');
    protected $metadatas = array('suggest');

    protected function getKeywordFileCache()
    {
        return strtr($this->keyword, ' ', '.');
    }

    public function setUp()
    {
        $this->engine = new GoogleImage();
        if(!CRAWL_IN_LIVE) {
            $crawler = new CachedCrawler();
            $crawler->setFilePattern(__DIR__ . '/sources/image/%s.html');
            $this->engine->setCrawler($crawler);
        }
    }

    public function keywordRegister($keyword)
    {
        $this->keyword = $keyword;
        $cache = __DIR__ . '/sources/image/' . $this->getKeywordFileCache() . '.html';
        if(!CRAWL_IN_LIVE && file_exists($cache)) {
            $crawler = $this->engine->getCrawler();
            $crawler->setSource(file_get_contents($cache));
        }
    }

    public function tearDown()
    {
        $cache = __DIR__ . '/sources/image/' . $this->getKeywordFileCache() . '.html';
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
        $this->assertEquals(20, count($linkSet->getImageResults()));
        $this->assertEquals(20, count($linkSet));
        
        // tests metadata
        $this->assertEquals(6, count($metadatasSet->getSuggest()));
    }
}
