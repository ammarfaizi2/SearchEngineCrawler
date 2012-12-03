<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Image as GoogleImage;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class ImageMetadatasTest extends TestCase
{
    protected $identifier = 'google.image';

    public function testCanCrawlResultMetadata()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleImage();
        $google->setCrawler($crawler);
        $set = $google->crawl('rooney', array(
            'metadatas' => array('suggest'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $metadatasSet = $set->getPage(1)->getMetadatas();
        $this->assertEquals(6, count($metadatasSet->getSuggest()));
    }
}
