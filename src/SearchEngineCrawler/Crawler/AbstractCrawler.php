<?php

namespace SearchEngineCrawler\Crawler;

use SearchEngineCrawler\Engine\Link\Builder\LinkBuilderManager;

abstract class AbstractCrawler implements CrawlerInterface
{
    protected $userAgent;

    protected $source;

    protected $linkBuilderManager;

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

    public function getLinkBuilderManager()
    {
        if(null === $this->linkBuilderManager) {
            $this->setLinkBuilderManager(new LinkBuilderManager());
        }
        return $this->linkBuilderManager;
    }

    public function setLinkBuilderManager(LinkBuilderManager $linkBuilderManager)
    {
        $this->linkBuilderManager = $linkBuilderManager;
        return $this;
    }
}
