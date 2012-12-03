<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\News as GoogleNews;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class NewsMetadatasTest extends TestCase
{
    protected $identifier = 'google.news';

    public function testCanCrawlNewsLinks()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleNews();
        $google->setCrawler($crawler);
        $set = $google->crawl('rooney', array(
            'links' => array('news', 'image', 'natural'),
            'metadatas' => array('results'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $metadatasSet = $set->getPage(1)->getMetadatas();
        $this->assertEquals(70100, (integer)$metadatasSet->getResults());
    }
}
