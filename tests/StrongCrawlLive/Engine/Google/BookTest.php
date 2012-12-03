<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace StrongCrawlLiveTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Book as GoogleBook;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class BookTest extends TestCase
{
    protected $engine;

    protected $keyword;

    protected $links = array('book', 'premium');
    protected $metadatas = array('results');

    protected function getKeywordFileCache()
    {
        return strtr($this->keyword, ' ', '.');
    }

    public function setUp()
    {
        $this->engine = new GoogleBook();
        if(!CRAWL_IN_LIVE) {
            $crawler = new CachedCrawler();
            $crawler->setFilePattern(__DIR__ . '/sources/book/%s.html');
            $this->engine->setCrawler($crawler);
        }
    }

    public function keywordRegister($keyword)
    {
        $this->keyword = $keyword;
        $cache = __DIR__ . '/sources/book/' . $this->getKeywordFileCache() . '.html';
        if(!CRAWL_IN_LIVE && file_exists($cache)) {
            $crawler = $this->engine->getCrawler();
            $crawler->setSource(file_get_contents($cache));
        }
    }

    public function tearDown()
    {
        $cache = __DIR__ . '/sources/book/' . $this->getKeywordFileCache() . '.html';
        if(CRAWL_UPDATE_CACHE || !file_exists($cache)) {
            $crawler = $this->engine->getCrawler();
            $source = $crawler->getSource();
            file_put_contents($cache, $source);
        }
        if(CRAWL_IN_LIVE) {
            sleep(2);
        }
    }

    public function test_ZendFramework_Case()
    {
        $this->keywordRegister('zend framework');

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
        $this->assertEquals(10, count($linkSet->getBookResults()));
        $this->assertEquals(1, count($linkSet->getPremiumResults()));
        $this->assertEquals(11, count($linkSet));
        
        // test metadatas
        $this->assertEquals(11600, (integer)$metadatasSet->getResults());
        
        // test details
        $this->assertEquals(
            'Pro Zend Framework Techniques: Build a Full CMS Project',
            $linkSet->getBookResults()->offsetGet(2)->getAnchor()
        );
        $this->assertEquals(
            array('John Coggeshall', 'Morgan Tocker'),
            $linkSet->getBookResults()->offsetGet(7)->getAuthor()
        );
        $this->assertEquals(
            '2009',
            $linkSet->getBookResults()->offsetGet(7)->getDate()
        );
    }
}
