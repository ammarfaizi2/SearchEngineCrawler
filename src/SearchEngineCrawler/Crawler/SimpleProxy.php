<?php

namespace SearchEngineCrawler\Crawler;

class SimpleProxy extends AbstractCrawler
{
    public function crawl($engine, $keyword, array $options = array())
    {
        $linkBuilder = $this->getLinkBuilderManager()->get($engine);
        $link = $linkBuilder->build($keyword, 1, $options);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_PROXY, '0.0.0.1');
        curl_setopt($curl,CURLOPT_PROXYPORT, 8080);
        curl_setopt($curl,CURLOPT_PROXYUSERPWD,'vblanchon:xxxx');
        $contents = curl_exec($curl);
        return $contents;
    }
}
