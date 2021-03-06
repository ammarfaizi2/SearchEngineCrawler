<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Crawler;

use SearchEngineCrawler\Engine\Link\Builder\BuilderInterface;
use SearchEngineCrawler\Engine\Link\Builder\LinkBuilderManager;

abstract class AbstractCrawler implements CrawlerInterface
{
    protected $userAgent;

    protected $source;

    protected $builder;

    public function crawl(array $options = array())
    {
        $linkBuilder = $this->getBuilder();
        $builderOptions = isset($options['builder']) ? $options['builder'] : array();
        $link = $linkBuilder->build($builderOptions);

        $content = $this->crawlUri($link);

        $this->setSource($content);
        return $this;
    }

    abstract protected function crawlUri($uri);

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    public function getBuilder()
    {
        return $this->builder;
    }

    public function setBuilder(BuilderInterface $builder)
    {
        $this->builder = $builder;
        return $this;
    }
}
