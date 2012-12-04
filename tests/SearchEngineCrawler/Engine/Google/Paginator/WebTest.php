<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Engine\Google\Paginator;

use PHPUnit_Framework_TestCase as TestCase;
use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;
use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;
use SearchEngineCrawlerTest\Crawler\CachedCrawler;

class WebTest extends TestCase
{
    public function testCanCrawlNaturalLinks()
    {
        if(!CRAWL_PAGINATOR) {
            return;
        }
        $google = new GoogleWeb();
        $google->setMaxDepth(3);
        $set = $google->crawl('zend framework', array(
            'links' => array('natural', 'video'),
            'builder' => array(
                'lang' => GoogleLinkBuilder::LANG_FR,
                'host' => GoogleLinkBuilder::HOST_FR,
            ),
        ));
        $this->assertEquals(true, $set->hasPage(1));
        $this->assertEquals(true, $set->hasPage(2));
        $this->assertEquals(true, $set->hasPage(3));

        $linkSet = $set->getPage(1)->getLinks();
        $this->assertEquals(10, count($linkSet));

        $linkSet = $set->getPage(2)->getLinks();
        $this->assertEquals(10, count($linkSet));

        $linkSet = $set->getPage(3)->getLinks();
        $this->assertEquals(10, count($linkSet));
    }
}
