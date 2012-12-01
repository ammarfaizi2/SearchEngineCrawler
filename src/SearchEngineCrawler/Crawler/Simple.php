<?php

namespace SearchEngineCrawler\Crawler;

class Simple extends AbstractCrawler
{
    public function crawl($engine, $keyword, array $options = array())
    {
        $linkBuilder = $this->getLinkBuilderManager()->get($engine);
        $link = $linkBuilder->build($keyword, 1, $options);
        $contents = file_get_contents($link);
        return $contents;
    }
}
