<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Youtube;

use SearchEngineCrawler\Engine\AbstractEngine;
use SearchEngineCrawler\Crawler\Match\Query as QueryMatch;

class Youtube extends AbstractEngine
{
    protected $builderClass = 'SearchEngineCrawler\Engine\Link\Builder\Youtube\Youtube';

    protected $defaultLinks = array('video');

    /**
     * Get the crawler match
     * @return MatchInterface
     */
    public function getCrawlerMatch()
    {
        if(null === $this->crawlerMatch) {
            $this->setCrawlerMatch(new QueryMatch());
        }
        return $this->crawlerMatch;
    }
}
