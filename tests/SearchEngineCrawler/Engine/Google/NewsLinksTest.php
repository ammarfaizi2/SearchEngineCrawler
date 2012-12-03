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

class NewsLinksTest extends TestCase
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
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $linkSet = $set->getPage(1)->getLinks();

        $this->assertEquals(12, count($linkSet->getNewsResults()));

        $this->assertEquals('France Football', $linkSet->getNewsResults()->offsetGet(0)->getSource());
        $this->assertEquals('DirectMatin.fr', $linkSet->getNewsResults()->offsetGet(1)->getSource());
        $this->assertEquals('Le Point', $linkSet->getNewsResults()->offsetGet(2)->getSource());
        $this->assertEquals('Pure People', $linkSet->getNewsResults()->offsetGet(3)->getSource());
        $this->assertEquals('29 nov. 2012', $linkSet->getNewsResults()->offsetGet(3)->getDate());
        $this->assertEquals('http://news.google.fr/news/tbn/Bu0RfPKGOoUJ/6.jpg', $linkSet->getNewsResults()->offsetGet(3)->getImage());

        $this->assertEquals(7, count($linkSet->getImageResults()));
        $this->assertEquals(1, count($linkSet->getNaturalResults()));
        $this->assertEquals(20, count($linkSet));
    }
}
