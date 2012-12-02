<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawlerTest\Crawler;

use SearchEngineCrawler\Crawler\AbstractCrawler;

class CachedCrawler extends AbstractCrawler
{
    protected $autoFileCached = false;

    protected $filePattern;

    public function crawl($engine, array $options = array())
    {
        if($this->autoFileCached) {
            $lang = $options['builder']['lang'];
            $page = $options['builder']['page'];
            $cache = $lang . '.' . strtr($options['builder']['keyword'], ' ', '.') . ($page > 1 ? '-' . $page : '') . '.html';
            $filename = __DIR__ . '/_files/' . $cache;
        } else {
            $filename = sprintf($this->filePattern, strtr($options['builder']['keyword'], ' ', '.'));
        }
        if(!file_exists($filename)) {
            $crawler = new Simple();
            return $crawler->crawl($engine, $options);
        }
        $contents = file_get_contents($filename);

        $this->setSource($contents);
        return $this;
    }

    protected function crawlUri($uri)
    {}

    public function setAutoFileCached($autoFileCached)
    {
        $this->autoFileCached = $autoFileCached;
        return $this;
    }

    public function setFilePattern($filePattern)
    {
        $this->filePattern = $filePattern;
        return $this;
    }
}
