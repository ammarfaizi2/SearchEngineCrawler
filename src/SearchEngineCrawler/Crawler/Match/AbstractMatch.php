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
use SearchEngineCrawler\Result\Match;
use Zend\Stdlib\Exception\InvalidArgumentException;

abstract class AbstractMatch implements MatchInterface
{
    protected $match;

    protected $options;

    /**
     * Match a link result
     * @param ResultInterface $result
     * @param integer|null $page
     * @param integer|nul $position
     * @return MatchResult|null
     */
    public function matchResult(ResultInterface $result, $page = null, $position = null)
    {
        if(!$this->match($result->getLink())) {
            return null;
        }
        return new Match($page, $position, $result);
    }

    /**
     * Match from a page container
     * @param PageContainer $page
     * @return Match|null
     */
    public function matchPage(PageContainer $page)
    {
        $links = $page->getLinks();
        foreach($links as $position => $link) {
            $match = $this->matchResult($link, $page->getNum(), $position + 1);
            if($match instanceof Match) {
                return $match;
            }
        }
    }

    /**
     * Match from a set of page
     * @param PageSet $pageSet
     * @return Match|null
     */
    public function matchPageSet(PageSet $pageSet)
    {
        foreach($pageSet as $page) {
            $match = $this->matchPage($page);
            if($match instanceof Match) {
                return $match;
            }
        }
    }

    /**
     * Get the string which must to match
     * @return string
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set the string which must to match
     * @return AbstractMatch
     */
    public function setMatch($match)
    {
        $this->match = $match;
        return $this;
    }

    /**
     * Get the match options
     * @return Options
     */
    public function getOptions()
    {
        if(null === $this->options) {
            $this->setOptions(new Options());
        }
        return $this->options;
    }

    /**
     * Set the match options
     * @param Options $options
     * @return AbstractMatch
     */
    public function setOptions($options)
    {
        if(is_array($options)) {
            $options = new Options($options);
        }
        if(!$options instanceof $options) {
            throw new InvalidArgumentException('Options must be an array or an Options instance');
        }
        $this->options = $options;
        return $this;
    }
}
