<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use SearchEngineCrawler\Engine\Google\News as GoogleNews;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Engine\AbstractTest;

class NewsTest extends AbstractTest
{
    protected $links = array('news', 'image', 'natural');
    protected $metadatas = array('results');

    public function setUp()
    {
        $this->cachePattern = __DIR__ . '/sources/news/%s.html';
        $this->engine = new GoogleNews();
        parent::setUp();
    }

    public function test_Rooney_Case()
    {
        $this->keywordRegister('rooney');

        $set = $this->engine->crawl($this->keyword, array(
            'links' => $this->links,
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
            'metadatas' => $this->metadatas,
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $metadatasSet = $set->getPage(1)->getMetadatas();

        // tests type of links
        $this->assertEquals(12, count($linkSet->getNewsResults()));
        $this->assertEquals(7, count($linkSet->getImageResults()));
        $this->assertEquals(1, count($linkSet->getNaturalResults()));
        $this->assertEquals(20, count($linkSet));

        // tests details
        $this->assertEquals('France Football', $linkSet->getNewsResults()->offsetGet(0)->getSource());
        $this->assertEquals('DirectMatin.fr', $linkSet->getNewsResults()->offsetGet(1)->getSource());
        $this->assertEquals('Le Point', $linkSet->getNewsResults()->offsetGet(2)->getSource());
        $this->assertEquals('Pure People', $linkSet->getNewsResults()->offsetGet(3)->getSource());
        $this->assertEquals('29 nov. 2012', $linkSet->getNewsResults()->offsetGet(3)->getDate());
        $this->assertEquals('http://news.google.fr/news/tbn/Bu0RfPKGOoUJ/6.jpg', $linkSet->getNewsResults()->offsetGet(3)->getImage());

        // tests metadatas
        $this->assertEquals(70100, (integer)$metadatasSet->getResults());
    }
}
