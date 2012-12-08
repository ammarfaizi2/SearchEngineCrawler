<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawlerTest\Engine\Youtube\Match;

use SearchEngineCrawler\Engine\Youtube\Youtube;
use SearchEngineCrawler\Result\Match;
use SearchEngineCrawlerTest\Engine\AbstractTest;

class YoutubeTest extends AbstractTest
{
    protected $links = array('video', 'premium', 'premium_bottom');
    protected $metadatas = array();

    public function setUp()
    {
        $this->cachePattern = __DIR__ . '/../sources/youtube/%s.html';
        $this->engine = new Youtube();
        parent::setUp();
    }

    public function test_LadyGaga_Case()
    {
        $this->keywordRegister('lady gaga');

        // test natural
        $match = $this->engine->match($this->keyword, 'http://www.youtube.com/watch?v=niqrrmev4mA', array(
            'links' => $this->links,
            'metadatas' => $this->metadatas,
        ));
        $this->assertEquals(true, $match instanceof Match);
        $this->assertEquals($match->getPosition(), 4);
        $this->assertEquals($match->getPage(), 1);
        $this->assertEquals($match->getLink()->getAuthor(), array('LadyGagaVEVO'));
        $this->assertEquals($match->getLink()->getViews(), 180952227);
    }
}
