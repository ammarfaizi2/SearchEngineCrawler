<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine\Google;

use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Engine\AbstractTest;

class WebTest extends AbstractTest
{
    protected $links = array('natural', 'image', 'map', 'news', 'premium', 'premium_bottom', 'product', 'video');
    protected $metadatas = array('suggest', 'word_spelling');

    public function setUp()
    {
        $this->cachePattern = __DIR__ . '/sources/web/%s.html';
        $this->engine = new GoogleWeb();
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
        $this->assertEquals(10, count($linkSet->getNaturalResults()));
        $this->assertEquals(0, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(0, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(0, count($linkSet->getVideoResults()));
        $this->assertEquals(10, count($linkSet));

        // tests extension
        $this->assertEquals(4, count($linkSet->getNaturalResults()->offsetGet(0)->getExtension()->getSitelinks()));

        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }

    public function test_RecetteGateauAuChocolat_Case()
    {
        $this->keywordRegister('recette gateau au chocolat');

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
        $this->assertEquals(9, count($linkSet->getNaturalResults()));
        $this->assertEquals(0, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(0, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(1, count($linkSet->getVideoResults()));
        $this->assertEquals(10, count($linkSet));

        // tests extension
        $this->assertEquals(3, count($linkSet->getNaturalResults()->offsetGet(0)->getExtension()->getSitelinks()));

        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
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
        $this->assertEquals(8, count($linkSet->getNaturalResults()));
        $this->assertEquals(4, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(0, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(2, count($linkSet->getVideoResults()));
        $this->assertEquals(14, count($linkSet));

        // tests extension
        $this->assertEquals(4, count($linkSet->getNaturalResults()->offsetGet(0)->getExtension()->getSitelinks()));

        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }

    public function test_RestaurantParis_Case()
    {
        $this->keywordRegister('restaurant paris');

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
        $this->assertEquals(10, count($linkSet->getNaturalResults()));
        $this->assertEquals(0, count($linkSet->getImageResults()));
        $this->assertEquals(7, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(3, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(0, count($linkSet->getVideoResults()));
        $this->assertEquals(20, count($linkSet));

        // tests extension
        $this->assertEquals(2, count($linkSet->getPremiumResults()->offsetGet(1)->getExtension()->getSitelinks()));
        // premium 3 has rating

        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }

    public function test_BourseParis_Case()
    {
        $this->keywordRegister('bourse paris');

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
        $this->assertEquals(10, count($linkSet->getNaturalResults()));
        $this->assertEquals(0, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(3, count($linkSet->getNewsResults()));
        $this->assertEquals(3, count($linkSet->getPremiumResults()));
        $this->assertEquals(3, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(0, count($linkSet->getVideoResults()));
        $this->assertEquals(19, count($linkSet));

        // tests extension
        $this->assertEquals(4, count($linkSet->getNaturalResults()->offsetGet(1)->getExtension()->getSitelinks()));
        $this->assertEquals(2, count($linkSet->getNaturalResults()->offsetGet(2)->getExtension()->getSitelinks()));
        $this->assertEquals(4, count($linkSet->getNaturalResults()->offsetGet(3)->getExtension()->getSitelinks()));
        $this->assertEquals(2, count($linkSet->getPremiumBottomResults()->offsetGet(1)->getExtension()->getSitelinks()));

        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }

    public function test_LadyGaga_Case()
    {
        $this->keywordRegister('lady gaga');

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
        $this->assertEquals(7, count($linkSet->getNaturalResults()));
        $this->assertEquals(5, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(3, count($linkSet->getNewsResults()));
        $this->assertEquals(0, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(3, count($linkSet->getVideoResults()));
        $this->assertEquals(18, count($linkSet));

        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }

    public function test_LadyGga_Case()
    {
        $this->keywordRegister('lady gga');

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
        $this->assertEquals(7, count($linkSet->getNaturalResults()));
        $this->assertEquals(0, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(3, count($linkSet->getNewsResults()));
        $this->assertEquals(0, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(0, count($linkSet->getProductResults()));
        $this->assertEquals(3, count($linkSet->getVideoResults()));
        $this->assertEquals(13, count($linkSet));

        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals('lady gaga', strtolower($metadatasSet->getWordSpelling()));
    }

    public function test_TableAManger_Case()
    {
        $this->keywordRegister('table a manger');

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
        $this->assertEquals(10, count($linkSet->getNaturalResults()));
        $this->assertEquals(0, count($linkSet->getImageResults()));
        $this->assertEquals(0, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(3, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(3, count($linkSet->getProductResults()));
        $this->assertEquals(0, count($linkSet->getVideoResults()));
        $this->assertEquals(16, count($linkSet));

        // tests extension
        $this->assertEquals(3, count($linkSet->getPremiumResults()->offsetGet(0)->getRichSnippet()->getProducts()));

        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }

    public function test_MobilierDeSalon_Case()
    {
        $this->keywordRegister('mobilier de salon');

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
        $this->assertEquals(9, count($linkSet->getNaturalResults()));
        $this->assertEquals(4, count($linkSet->getImageResults()));
        $this->assertEquals(4, count($linkSet->getMapResults()));
        $this->assertEquals(0, count($linkSet->getNewsResults()));
        $this->assertEquals(3, count($linkSet->getPremiumResults()));
        $this->assertEquals(0, count($linkSet->getPremiumBottomResults()));
        $this->assertEquals(3, count($linkSet->getProductResults()));
        $this->assertEquals(0, count($linkSet->getVideoResults()));
        $this->assertEquals(23, count($linkSet));

        // tests extension
        $this->assertEquals(4, count($linkSet->getPremiumResults()->offsetGet(0)->getExtension()->getSitelinks()));
        // premium 1 & 3 has rating

        // tests metadata
        $this->assertEquals(8, count($metadatasSet->getSuggest()));
        $this->assertEquals(null, $metadatasSet->getWordSpelling());
    }
}
