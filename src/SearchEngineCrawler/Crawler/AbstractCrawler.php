<?php

namespace SearchEngineCrawler\Crawler;

use SearchEngineCrawler\Engine\Link\Builder\LinkBuilderManager;

abstract class AbstractCrawler implements CrawlerInterface
{
    protected $linkBuilderManager;

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
