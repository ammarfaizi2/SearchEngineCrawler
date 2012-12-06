<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Crawler\Match;

use SearchEngineCrawler\Result\Match as MatchResult;
use SearchEngineCrawler\ResultSet\Link\Result\ResultInterface;
use Zend\Uri\Http as UriHttp;

class Query extends Simple
{
    /**
     * Match a link
     * @param string $link
     * @return MatchResult|null
     */
    public function match($link)
    {
        $match = parent::match($link);
        if(false === $match) {
            return false;
        }

        $options = $this->getOptions();
        $match = $this->getMatch();

        $match = new UriHttp($match);
        $link = new UriHttp($link);

        if($link->getQuery() != $match->getQuery()) {
            return false;
        }

        return true;
    }
}
