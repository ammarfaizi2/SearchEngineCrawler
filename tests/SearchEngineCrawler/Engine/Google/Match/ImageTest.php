<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine\Google\Match;

use SearchEngineCrawler\Engine\Google\Image as GoogleImage;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawler\Result\Match;
use SearchEngineCrawlerTest\Engine\AbstractTest;

class ImageTest extends AbstractTest
{
    protected $links = array('image');

    public function setUp()
    {
        $this->cachePattern = __DIR__ . '/../sources/image/%s.html';
        $this->engine = new GoogleImage();
        parent::setUp();
    }

    public function test_Rooney_Case()
    {
        $this->keywordRegister('rooney');

        $crawlerMatch = $this->engine->getCrawlerMatch();
        $crawlerMatch->setOptions(array(
            'strictMode' => false,
            'strictDns' => false,
        ));
        $match = $this->engine->match($this->keyword, 'http://www.lequipe.fr', array(
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $this->assertEquals(true, $match instanceof Match);
        $this->assertEquals($match->getPosition(), 3);
        $this->assertEquals($match->getPage(), 1);
    }
}
