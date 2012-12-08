<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use SearchEngineCrawler\Engine\Youtube\Youtube;
use SearchEngineCrawlerTest\Engine\AbstractTest;

class YoutubeTest extends AbstractTest
{
    protected $links = array('video', 'premium', 'premium_bottom');
    protected $metadatas = array();

    public function setUp()
    {
        $this->cachePattern = __DIR__ . '/sources/youtube/%s.html';
        $this->engine = new Youtube();
        parent::setUp();
    }

    public function test_LadyGaga_Case()
    {
        $this->keywordRegister('lady gaga');

        $set = $this->engine->crawl($this->keyword, array(
            'links' => $this->links,
            'metadatas' => $this->metadatas,
        ));
        $linkSet = $set->getPage(1)->getLinks();
        $metadatasSet = $set->getPage(1)->getMetadatas();

        // tests type of links
        $this->assertEquals(20, count($linkSet->getVideoResults()));
        $this->assertEquals(1, count($linkSet->getPremiumResults()));
        $this->assertEquals(1, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(22, count($linkSet));
    }
}
