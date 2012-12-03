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
use SearchEngineCrawler\Result\Match;

class VideoLinksMatchTest extends TestCase
{
    protected $identifier = 'google.video';

    public function testCanMatch_StrictDns_StrictUri()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleVideo();
        $google->setCrawler($crawler);
        $crawlerMatch = $google->getCrawlerMatch();
        $crawlerMatch->setOptions(array(
            'strictMode' => false,
            'strictDns' => false,
        ));
        $match = $google->match('bieber', 'http://tmz.com');
        $this->assertEquals(true, $match instanceof Match);
        $this->assertEquals($match->getPosition(), 4);
        $this->assertEquals($match->getPage(), 1);
    }
}
