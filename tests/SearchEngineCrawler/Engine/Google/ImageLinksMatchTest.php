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
use SearchEngineCrawler\Result\Match;

class ImageLinksMatchTest extends TestCase
{
    protected $identifier = 'google.image';

    public function testCanMatch_StrictDns_StrictUri()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleImage();
        $google->setCrawler($crawler);
        $crawlerMatch = $google->getCrawlerMatch();
        $crawlerMatch->setOptions(array(
            'strictMode' => false,
            'strictDns' => false,
        ));
        $match = $google->match('rooney', 'http://www.lequipe.fr', array(
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $this->assertEquals(true, $match instanceof Match);
        $this->assertEquals($match->getPosition(), 3);
        $this->assertEquals($match->getPage(), 1);
    }
}
