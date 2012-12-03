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

class VideoMetadatasTest extends TestCase
{
    protected $identifier = 'google.video';

    public function testCanCrawlResultMetadata()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $set = $google->crawl('bieber', array(
            'links' => array('video', 'natural'),
            'metadatas' => array('results'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $metadatasSet = $set->getPage(1)->getMetadatas();
        $this->assertEquals(487000000, (integer)$metadatasSet->getResults());
    }
}
