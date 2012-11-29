<?php

namespace SearchEngineCrawler\Crawler;

interface CrawlerInterface
{
    public function crawl($engine, $keyword, array $options = array());
}