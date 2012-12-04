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

class Simple extends AbstractMatch
{
    /**
     * Match a link
     * @param string $link
     * @return MatchResult|null
     */
    public function match($link)
    {
        $options = $this->getOptions();
        $match = $this->getMatch();
        $match = new UriHttp($match);

        $strictDns = $options->getStrictDns();
        $strictMode = $options->getStrictMode();

        $link = new UriHttp($link);

        if($strictDns) {
            if($match->getHost() != $link->getHost()) {
                return false;
            }
        } else {
            preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $link->getHost(), $regs);
            $dnsLink = $regs['domain'];

            preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $match->getHost(), $regs);
            $dnsMatch = $regs['domain'];

            if($dnsLink != $dnsMatch) {
                return false;
            }
        }

        $matchPath = strlen($match->getPath()) > 1 ? preg_replace('#\/$#', "", $match->getPath()) : $match->getPath(); // delete last /
        $linkPath = strlen($link->getPath()) > 1 ? preg_replace('#\/$#', "", $link->getPath()) : $link->getPath(); // delete last /
        if($strictMode) {
            if($matchPath != $linkPath) {
                return false;
            }
        } else {
            if(false === strpos($linkPath, $matchPath)) {
                return false;
            }
        }

        return true;
    }
}
