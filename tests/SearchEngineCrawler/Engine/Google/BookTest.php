<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use SearchEngineCrawler\Engine\Google\Book as GoogleBook;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Engine\AbstractTest;

class BookTest extends AbstractTest
{
    protected $links = array('book', 'premium');
    protected $metadatas = array('results');

    public function setUp()
    {
        $this->cachePattern = __DIR__ . '/sources/book/%s.html';
        $this->engine = new GoogleBook();
        parent::setUp();
    }

    public function test_ZendFramework_Case()
    {
        $this->keywordRegister('zend framework');

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
        $this->assertEquals(10, count($linkSet->getBookResults()));
        $this->assertEquals(1, count($linkSet->getPremiumResults()));
        $this->assertEquals(11, count($linkSet));

        // test metadatas
        $this->assertEquals(11600, (integer)$metadatasSet->getResults());

        // test details
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
