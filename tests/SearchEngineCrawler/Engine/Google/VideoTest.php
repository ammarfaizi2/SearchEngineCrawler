<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use SearchEngineCrawler\Engine\Google\Video as GoogleVideo;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Engine\AbstractTest;

class VideoTest extends AbstractTest
{
    protected $links = array('video', 'natural');
    protected $metadatas = array('results');

    public function setUp()
    {
        $this->cachePattern = __DIR__ . '/sources/video/%s.html';
        $this->engine = new GoogleVideo();
        parent::setUp();
    }

    public function test_Bieber_Case()
    {
        $this->keywordRegister('bieber');

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
        $this->assertEquals(9, count($linkSet->getVideoResults()));
        $this->assertEquals(1, count($linkSet->getNaturalResults()));
        $this->assertEquals(10, count($linkSet));

        // test extension
        $this->assertEquals(2, count($linkSet->getNaturalResults()->offsetGet(0)->getExtension()->getSitelinks()));

        // test metadatas
        $this->assertEquals(487000000, (integer)$metadatasSet->getResults());
    }
}
