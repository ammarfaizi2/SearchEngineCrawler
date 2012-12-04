<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Crawler\Match;

use SearchEngineCrawler\ResultSet\Link\Result\ResultInterface;
use SearchEngineCrawler\ResultSet\Page\Container as PageContainer;
use SearchEngineCrawler\ResultSet\ResultSet as PageSet;

interface MatchInterface
{
    /**
     * Match a link
     * @param string $link
     * @return MatchResult|null
     */
    public function match($link);

    /**
     * Match a link result
     * @param ResultInterface $result
     * @param integer|null $page
     * @param integer|nul $position
     * @return MatchResult|null
     */
    public function matchResult(ResultInterface $result, $page = null, $position = null);

    /**
     * Match from a page container
     * @param PageContainer $page
     * @return Match|null
     */
    public function matchPage(PageContainer $pageContainer);

    /**
     * Match from a set of page
     * @param PageSet $pageSet
     * @return Match|null
     */
    public function matchPageSet(PageSet $pageSet);

    /**
     * Get the string/array of string which must to match
     * @return mixed
     */
    public function getMatch();

    /**
     * Set the string/array of string which must to match
     * @return MatchInterface
     */
    public function setMatch($match);
}
