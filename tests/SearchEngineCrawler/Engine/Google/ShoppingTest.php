<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use SearchEngineCrawler\Engine\Google\Shopping as GoogleShopping;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Engine\AbstractTest;

class ShoppingTest extends AbstractTest
{
    protected $links = array('product', 'premium', 'premium_bottom');
    protected $metadatas = array('results');

    public function setUp()
    {
        $this->cachePattern = __DIR__ . '/sources/shopping/%s.html';
        $this->engine = new GoogleShopping();
        parent::setUp();
    }

    public function test_TableBasse_Case()
    {
        $this->keywordRegister('table basse');

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
        $this->assertEquals(3, count($linkSet->getPremiumResults()));
        $this->assertEquals(3, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(10, count($linkSet->getProductResults()));
        $this->assertEquals(16, count($linkSet));

        // tests details
        $price = $linkSet->getProductResults()->offsetGet(0)->getPrice();
        $this->assertEquals('239', (integer)$price);

        // tests metadatas
        $this->assertEquals(31300, (integer)$metadatasSet->getResults());
    }
}
