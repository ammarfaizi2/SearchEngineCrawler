<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawlerTest\Engine\Google\Match;

use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawler\Result\Match;
use SearchEngineCrawlerTest\Engine\AbstractTest;

class WebTest extends AbstractTest
{
    protected $links = array('natural', 'image', 'map', 'news', 'premium', 'premium_bottom', 'product', 'video');

    public function setUp()
    {
        $this->cachePattern = __DIR__ . '/../sources/web/%s.html';
        $this->engine = new GoogleWeb();
        parent::setUp();
    }

    /**
     * Test all config once
     * The 4 use case are with the same keyword
     *
     */
    public function testCanMatch_StrictDns_StrictUri()
    {
        $this->keywordRegister('zend framework');

        $crawlerMatch = $this->engine->getCrawlerMatch();
        $crawlerMatch->setOptions(array(
            'strictMode' => true,
            'strictDns' => true,
        ));
        $match = $this->engine->match($this->keyword, 'http://framework.zend.com', array(
            'links' => $this->links,
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $this->assertTrue($match instanceof Match);
        $this->assertEquals($match->getPosition(), 1);
        $this->assertEquals($match->getPage(), 1);
    }

    public function testCanMatch_StrictDns_NoStrictUri()
    {
        $this->keywordRegister('zend framework');

        $crawlerMatch = $this->engine->getCrawlerMatch();;
        $crawlerMatch->setOptions(array(
            'strictMode' => false,
            'strictDns' => true,
        ));
        $match = $this->engine->match($this->keyword, 'http://www.zend.com', array(
            'links' => $this->links,
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $this->assertTrue($match instanceof Match);
        $this->assertEquals($match->getPosition(), 2);
        $this->assertEquals($match->getPage(), 1);
    }

    public function testCanMatch_NoStrictDns_StrictUri()
    {
        $this->keywordRegister('zend framework');

        $crawlerMatch = $this->engine->getCrawlerMatch();
        $crawlerMatch->setOptions(array(
            'strictMode' => true,
            'strictDns' => false,
        ));
        $match = $this->engine->match($this->keyword, 'http://zend.com/fr/community/framework/', array(
            'links' => $this->links,
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $this->assertTrue($match instanceof Match);
        $this->assertEquals($match->getPosition(), 2);
        $this->assertEquals($match->getPage(), 1);
    }

    public function testCanMatch_NoStrictDns_NoStrictUri()
    {
        $this->keywordRegister('zend framework');

        $crawlerMatch = $this->engine->getCrawlerMatch();
        $crawlerMatch->setOptions(array(
            'strictMode' => false,
            'strictDns' => false,
        ));
        $match = $this->engine->match($this->keyword, 'http://zend.com', array(
            'links' => $this->links,
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $this->assertTrue($match instanceof Match);
        $this->assertEquals($match->getPosition(), 1);
        $this->assertEquals($match->getPage(), 1);
    }

    public function testCanMatch_NoStrictDns_NoStrictUri_WithOptions()
    {
        $this->keywordRegister('zend framework');

        $match = $this->engine->match($this->keyword, 'http://zend.com', array(
            'links' => $this->links,
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
            'match' => array(
                'strictMode' => false,
                'strictDns' => false,
            ),
        ));
        $this->assertTrue($match instanceof Match);
        $this->assertEquals($match->getPosition(), 1);
        $this->assertEquals($match->getPage(), 1);
    }

    public function test_RecetteGateauAuChocolat_Case()
    {
        $this->keywordRegister('recette gateau au chocolat');

        $match = $this->engine->match($this->keyword, 'http://gateau.com/gateau-au-chocolat-moelleux.htm', array(
            'links' => $this->links,
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
            'match' => array(
                'strictMode' => true,
                'strictDns' => true,
            ),
        ));
        $this->assertTrue($match instanceof Match);
        $this->assertEquals($match->getPosition(), 2);
        $this->assertEquals($match->getPage(), 1);
    }

    public function test_Rooney_Case()
    {
        $this->keywordRegister('rooney');

        $match = $this->engine->match($this->keyword, 'http://www.eurosport.fr/', array(
            'links' => $this->links,
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
            'match' => array(
                'strictMode' => false,
                'strictDns' => false,
            ),
        ));
        $this->assertTrue($match instanceof Match);
        $this->assertEquals($match->getPosition(), 8);
        $this->assertEquals($match->getPage(), 1);
    }
}
