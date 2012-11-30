<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Result\Map as MapResult;
use SearchEngineCrawler\ResultSet\Link\ResultSet;

class Map extends AbstractLink
{
    public function detect(&$source)
    {
        $results = new ResultSet();

        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($source);
        $nodes = $domQuery->queryXpath('//div[@id="ires"]//li[@class="g"]');
        foreach($nodes as $node) {
            // get link node
            $nodePath = $node->getNodePath();
            $nodePath .= '/div[contains(@data-extra, "lumarker")]/h3[@class="r"]/a[@class="l"]';
            $link = $domQuery->queryXpath($nodePath)->current();
            if(null === $link) {
                continue; // not a map link
            }
            // get address
            $nodePath = $node->getNodePath();
            $nodePath .= '/div[contains(@data-extra, "lumarker=")]//table[contains(@class, "intrlu")]//td';
            $address = $domQuery->queryXpath($nodePath);
            if($address->count() < 2) {
                continue; // not a address link
            }
            $map = $address->current();
            $address = $address->next();
            // get map link
            $nodePath = $map->getNodePath();
            $nodePath .= '//a';
            $map = $domQuery->queryXpath($nodePath)->current();
            // create datas
            $result = new MapResult(array(
                'position' => $node->getLineNo(),
                'ad' => $node->ownerDocument->saveHtml($node),
                'link' => $link->getAttribute('href'),
                'anchor' => $link->textContent,
                'address' => $address->textContent,
                'map' => $map->getAttribute('href'),
            ));
            $results->append($result);
        }
        return $results;
    }
}
