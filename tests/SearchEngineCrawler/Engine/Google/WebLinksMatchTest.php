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
use SearchEngineCrawler\Result\Match;

class WebLinksMatchTest extends TestCase
{
    protected $identifier = 'google.web';

    public function testCanMatch_StrictDns_StrictUri()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $crawlerMatch = $google->getCrawlerMatch();
        $crawlerMatch->setOptions(array(
            'strictMode' => true,
            'strictDns' => true,
        ));
        $match = $google->match('zend framework', 'http://framework.zend.com');
        $this->assertEquals(true, $match instanceof Match);
        $this->assertEquals($match->getPosition(), 1);
        $this->assertEquals($match->getPage(), 1);
    }

    public function testCanMatch_StrictDns_NoStrictUri()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $crawlerMatch = $google->getCrawlerMatch();
        $crawlerMatch->setOptions(array(
            'strictMode' => false,
            'strictDns' => true,
        ));
        $match = $google->match('zend framework', 'http://www.zend.com', array(
            'links' => array('natural'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $this->assertEquals(true, $match instanceof Match);
        $this->assertEquals($match->getPosition(), 3);
        $this->assertEquals($match->getPage(), 1);
    }

    public function testCanMatch_NoStrictDns_StrictUri()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $crawlerMatch = $google->getCrawlerMatch();
        $crawlerMatch->setOptions(array(
            'strictMode' => true,
            'strictDns' => false,
        ));
        $match = $google->match('zend framework', 'http://zend.com/fr/community/framework/', array(
            'links' => array('natural'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $this->assertEquals(true, $match instanceof Match);
        $this->assertEquals($match->getPosition(), 3);
        $this->assertEquals($match->getPage(), 1);
    }

    public function testCanMatch_NoStrictDns_NoStrictUri()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $crawlerMatch = $google->getCrawlerMatch();
        $crawlerMatch->setOptions(array(
            'strictMode' => false,
            'strictDns' => false,
        ));
        $match = $google->match('zend framework', 'http://zend.com', array(
            'links' => array('natural'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $this->assertEquals(true, $match instanceof Match);
        $this->assertEquals($match->getPosition(), 1);
        $this->assertEquals($match->getPage(), 1);
    }

    public function testCanMatch_NoStrictDns_NoStrictUri_WithOptions()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleWeb();
        $google->setCrawler($crawler);
        $match = $google->match('zend framework', 'http://zend.com', array(
            'links' => array('natural'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
            'match' => array(
                'strictMode' => false,
                'strictDns' => false,
            ),
        ));
        $this->assertEquals(true, $match instanceof Match);
        $this->assertEquals($match->getPosition(), 1);
        $this->assertEquals($match->getPage(), 1);
    }
}
