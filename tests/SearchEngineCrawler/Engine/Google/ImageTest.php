<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use SearchEngineCrawler\Engine\Google\Image as GoogleImage;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Engine\AbstractTest;

class ImageTest extends AbstractTest
{
    protected $links = array('image');
    protected $metadatas = array('suggest');

    public function setUp()
    {
        $this->cachePattern = __DIR__ . '/sources/image/%s.html';
        $this->engine = new GoogleImage();
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
        $this->assertEquals(20, count($linkSet->getImageResults()));
        $this->assertEquals(20, count($linkSet));

        // tests metadata
        $this->assertEquals(6, count($metadatasSet->getSuggest()));
    }
}
