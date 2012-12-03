<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Book as GoogleBook;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class BookLinksTest extends TestCase
{
    protected $identifier = 'google.book';

    public function testCanCrawlBookLinks()
    {
        $crawler = new CachedCrawler();
        $crawler->setAutoFileCached(true);
        $crawler->setIdentifier($this->identifier);

        $google = new GoogleBook();
        $google->setCrawler($crawler);
        $set = $google->crawl('zend framework', array(
            'links' => array('book', 'premium'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $linkSet = $set->getPage(1)->getLinks();

        $this->assertEquals(10, count($linkSet->getBookResults()));
        $this->assertEquals(1, count($linkSet->getPremiumResults()));
        $this->assertEquals(11, count($linkSet));

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
