<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Result\Natural as NaturalResult;
use SearchEngineCrawler\ResultSet\Link\ResultSet;

class Natural extends AbstractLink
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
            $nodePath .= '/div[@class="vsc"]/h3[@class="r"]/a[@class="l"]';
            $link = $domQuery->queryXpath($nodePath)->current();
            if(null === $link) {
                continue; // not a natural link
            }
            // create datas
            $result = new NaturalResult(array(
                'position' => $node->getLineNo(),
                'ad' => $node->ownerDocument->saveHtml($node),
                'link' => $link->getAttribute('href'),
                'anchor' => $link->textContent,
            ));
            $results->append($result);
        }
        return $results;
    }
}
