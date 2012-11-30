<?php

namespace SearchEngineCrawler\Engine;

use SearchEngineCrawler\Crawler\CrawlerInterface;
use SearchEngineCrawler\Crawler\Simple as SimpleCrawler;
use SearchEngineCrawler\Engine\Link\LinkPluginManager;
use SearchEngineCrawler\Engine\Metadata\MetadataPluginManager;

abstract class AbstractEngine implements EngineInterface
{
    protected $currentPage = 1;

    protected $maxPage = 1;

    protected $crawler;

    protected $linkPluginManager;

    protected $metadataPluginManager;

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

    public function getCrawler()
    {
        if(null === $this->crawler) {
            $this->setCrawler(new SimpleCrawler());
        }
        return $this->crawler;
    }

    public function setCrawler(CrawlerInterface $crawler)
    {
        $this->crawler = $crawler;
        return $this;
    }
}
