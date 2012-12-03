<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Video as GoogleVideo;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class VideoLinksTest extends TestCase
{
    protected $identifier = 'google.video';

    public function testCanCrawlNaturalVideoLinks()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleVideo();
        $google->setCrawler($crawler);
        $set = $google->crawl('bieber', array(
            'links' => array('video', 'natural'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $linkSet = $set->getPage(1)->getLinks();

        $this->assertEquals(9, count($linkSet->getVideoResults()));
        $this->assertEquals(1, count($linkSet->getNaturalResults()));
        $this->assertEquals(10, count($linkSet));
        $this->assertEquals(2, count($linkSet->getNaturalResults()->offsetGet(0)->getExtension()->getSitelinks()));
    }
}
