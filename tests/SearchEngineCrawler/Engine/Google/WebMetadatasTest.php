<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class WebMetadatasTest extends TestCase
{
    protected $identifier = 'google.web';

    public function testCanCrawlResultMetadata()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('zend framework', array(
            'links' => array('natural'),
            'metadatas' => array('results'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $metadatasSet = $set->getPage(1)->getMetadatas();
        $this->assertEquals(5970000, (integer)$metadatasSet->getResults());
    }

    public function testCanCrawlWordspellingMetadata()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('talbe a manger', array(
            'links' => array('natural'),
            'metadatas' => array('word_spelling'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $metadatasSet = $set->getPage(1)->getMetadatas();
        $this->assertEquals('table a manger', $metadatasSet->getWordSpelling());
    }

    public function testCanCrawlSuggestMetadata()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('zend framework', array(
            'links' => array('natural'),
            'metadatas' => array('suggest'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $metadatasSet = $set->getPage(1)->getMetadatas();
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
    }
}
