<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
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
        $this->assertEquals(10, $newsResults = count($linkSet->getNewsResults()));
        $this->assertEquals(7, $imageResults = count($linkSet->getImageResults()));
        $this->assertEquals(0, $naturalResults = count($linkSet->getNaturalResults()));
        $this->assertEquals($newsResults+$imageResults+$naturalResults, count($linkSet));

        // tests details
        $this->assertEquals('Le 10 sport', $linkSet->getNewsResults()->offsetGet(0)->getSource());
        $this->assertEquals('Maxifoot', $linkSet->getNewsResults()->offsetGet(1)->getSource());
        $this->assertEquals('metronews', $linkSet->getNewsResults()->offsetGet(2)->getSource());
        $this->assertEquals('Manchester Devils', $linkSet->getNewsResults()->offsetGet(3)->getSource());
        $this->assertEquals('23 sept. 2013', $linkSet->getNewsResults()->offsetGet(4)->getDate());
        $this->assertTrue(strpos($linkSet->getNewsResults()->offsetGet(3)->getImage(), 'https://encrypted-tbn0.gstatic.com/images#') == 0);

        // tests metadatas
        $this->assertEquals(1520000, (integer)$metadatasSet->getResults());
    }
}
