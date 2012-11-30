<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Result\Map as MapResult;

class Map extends AbstractLink
{
    public function detect(&$source)
    {
        $nodes = $this->xpath('//div[@id="ires"]//li[@class="g"]');
        foreach($nodes as $node) {
            // get link node
            $nodePath = $node->getNodePath();
            $nodePath .= '/div[contains(@data-extra, "lumarker")]/h3[@class="r"]/a[@class="l"]';
            $link = $this->xpath($nodePath)->current();
            if(null === $link) {
                continue; // not a map link
            }
            // get address
            $nodePath = $node->getNodePath();
            $nodePath .= '/div[contains(@data-extra, "lumarker=")]//table[contains(@class, "intrlu")]//td';
            $address = $this->xpath($nodePath);
            if($address->count() < 2) {
                continue; // not a address link
            }
            $map = $address->current();
            $address = $address->next();
            // get map link
            $nodePath = $map->getNodePath();
            $nodePath .= '//a';
            $map = $this->xpath($nodePath)->current();
            // create datas
            $result = new MapResult(array(
                'position' => $node->getLineNo(),
                'ad' => $node->ownerDocument->saveHtml($node),
                'link' => $link->getAttribute('href'),
                'anchor' => $link->textContent,
                'address' => $address->textContent,
                'map' => $map->getAttribute('href'),
            ));
            $this->append($result);
        }
    }
}
