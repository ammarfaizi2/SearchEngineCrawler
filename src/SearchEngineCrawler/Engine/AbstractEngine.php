<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine;

use SearchEngineCrawler\Crawler\CrawlerInterface;
use SearchEngineCrawler\Crawler\Match\MatchInterface;
use SearchEngineCrawler\Crawler\Simple as SimpleCrawler;
use SearchEngineCrawler\Crawler\Match\Simple as SimpleMatch;
use SearchEngineCrawler\Engine\Link\LinkPluginManager;
use SearchEngineCrawler\Engine\Metadata\MetadataPluginManager;
use SearchEngineCrawler\Result\Match;
use SearchEngineCrawler\ResultSet\Link\ResultSet as LinkSet;
use SearchEngineCrawler\ResultSet\Metadata\ResultSet as MetadataSet;
use SearchEngineCrawler\ResultSet\Page\Container as PageContainer;
use SearchEngineCrawler\ResultSet\ResultSet;
use Zend\Stdlib\Exception\InvalidArgumentException;

abstract class AbstractEngine implements EngineInterface
{
    protected $maxDepth = 1;

    protected $crawler;

    protected $crawlerMatch;

    protected $builderClass;

    protected $linkPluginManager;

    protected $metadataPluginManager;

    protected $defaultLinks;

    /**
     * Crawl list of results
     * @param string $keyword the keyword to parse
     * @param array $options parser & link builder options
     * @return ResultSet
     */
    public function crawl($keyword = null, array $options = array())
    {
        $set = new ResultSet();

        if($keyword) {
            $options = array_replace_recursive($options, array(
                'builder' => array(
                    'keyword' => $keyword,
                ),
            ));
        }

        $page = 1;
        $maxDepth = $this->getMaxDepth();
        for($page; $page <= $maxDepth; $page++) {
            $options = array_replace_recursive($options, array(
                'builder' => array(
                    'page' => $page,
                ),
            ));

            $pageContainer = $this->crawlPage($page, $options);
            $set->setPage($page, $pageContainer);
        }
        return $set;
    }

    /**
     * Match uri with the list of results
     * @param string $keyword the keyword to parse
     * @param string $match uri to parse
     * @param array $options parser & link builder options
     * @return Match|null
     */
    public function match($keyword = null, $match = null, array $options = array())
    {
        if($keyword) {
            $options = array_replace_recursive($options, array(
                'builder' => array(
                    'keyword' => $keyword,
                ),
            ));
        }
        if($match) {
            $crawlerMatch = $this->getCrawlerMatch();
            $crawlerMatch->setMatch($match);
        }
        if(isset($options['match'])) {
            $crawlerMatch = $this->getCrawlerMatch();
            $opts = $crawlerMatch->getOptions();
            $opts->setFromArray($options['match']);
        }

        $page = 1;
        $maxDepth = $this->getMaxDepth();
        for($page; $page <= $maxDepth; $page++) {
            $options = array_replace_recursive($options, array(
                'builder' => array(
                    'page' => $page,
                ),
            ));

            $pageContainer = $this->crawlPage($page, $options);

            $crawlerMatch = $this->getCrawlerMatch();
            $match = $crawlerMatch->matchPage($pageContainer);
            if($match instanceof Match) {
                return $match;
            }
        }
    }

    /**
     * Get links of page results
     * @param $page number of the page
     * @param $options
     * @return PageContainer
     */
    protected function crawlPage($page, array $options = array())
    {
        // create container
        $linkSet = new LinkSet();
        $metadataSet = new MetadataSet();
        $pageContainer = new PageContainer($page);

        // crawl the page
        $crawler = $this->getCrawler();
        $crawler->crawl($options);
        $source = $crawler->getSource();

        // get links, natural only by default
        if(!isset($options['links'])) {
            $options['links'] = $this->defaultLinks;
        }
        foreach($options['links'] as $link) {
            $link = $this->getLink($link);
            $link->source($source)->detect();
            $result = $link->getResults();
            $linkSet->merge($result);
        }
        $linkSet->sort();
        $pageContainer->setLinks($linkSet);

        // get metadatas
        if(isset($options['metadatas'])) {
            foreach($options['metadatas'] as $metadata) {
                $metadata = $this->getMetadata($metadata);
                $metadata->source($source)->find();
                $metadataSet->addMetadata($metadata);
            }
        }
        $pageContainer->setMetadatas($metadataSet);
        return $pageContainer;
    }

    public function getMaxDepth()
    {
        return $this->maxDepth;
    }

    public function setMaxDepth($maxDepth)
    {
        $maxDepth = (integer)$maxDepth;
        if($maxDepth <= 1) {
            throw new InvalidArgumentException('Page must be a positive integer');
        }
        $this->maxDepth = $maxDepth;
        return $this;
    }

    public function getCrawler()
    {
        if(null === $this->crawler) {
            $this->setCrawler(new SimpleCrawler());
        }
        return $this->crawler;
    }

    public function setCrawler(CrawlerInterface $crawler)
    {
        $builder = new $this->builderClass();
        $crawler->setBuilder($builder);
        $this->crawler = $crawler;
        return $this;
    }

    /**
     * Get the crawler match
     * @return MatchInterface
     */
    public function getCrawlerMatch()
    {
        if(null === $this->crawlerMatch) {
            $this->setCrawlerMatch(new SimpleMatch());
        }
        return $this->crawlerMatch;
    }

    /**
     * Set the crawler match
     * @param MatchInterface $crawlerMatch
     * @return AbstractEngine
     */
    public function setCrawlerMatch(MatchInterface $crawlerMatch)
    {
        $this->crawlerMatch = $crawlerMatch;
        return $this;
    }

    public function getLink($link)
    {
        $class = get_class($this);
        $prefix = substr($class, strrpos($class, 'Engine') + strlen('Engine') + 1);
        $prefix = preg_replace('#\\\#', '', $prefix);

        return $this->getLinkPluginManager()->get(strtolower($prefix . ucfirst($link)));
    }

    public function getLinkPluginManager()
    {
        if(null === $this->linkPluginManager) {
            $this->setLinkPluginManager(new LinkPluginManager());
        }
        return $this->linkPluginManager;
    }

    public function setLinkPluginManager(LinkPluginManager $linkPluginManager)
    {
        $this->linkPluginManager = $linkPluginManager;
        return $this;
    }

    public function getMetadata($metadata)
    {
        $class = get_class($this);
        $prefix = substr($class, strrpos($class, 'Engine') + strlen('Engine') + 1);
        $prefix = preg_replace('#\\\#', '', $prefix);

        return $this->getMetadataPluginManager()->get(strtolower($prefix . ucfirst($metadata)));
    }

    public function getMetadataPluginManager()
    {
        if(null === $this->metadataPluginManager) {
            $this->setMetadataPluginManager(new MetadataPluginManager());
        }
        return $this->metadataPluginManager;
    }

    public function setMetadataPluginManager(MetadataPluginManager $metadataPluginManager)
    {
        $this->metadataPluginManager = $metadataPluginManager;
        return $this;
    }
}
