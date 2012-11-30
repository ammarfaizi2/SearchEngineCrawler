<?php

namespace SearchEngineCrawler\Crawler;

use SearchEngineCrawler\Engine\Link\Builder\LinkBuilderManager;

abstract class AbstractCrawler implements CrawlerInterface
{
    protected $linkBuilderManager;

    protected function formatOutput(&$source)
    {
        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = false;
        //$dom->strictErrorChecking = false;
        @$dom->loadHTML($source);
        $dom->formatOutput = true;
        $source = $dom->saveHTML();

        return $source;
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
