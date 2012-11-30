<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Result\News as NewsResult;
use SearchEngineCrawler\ResultSet\Link\ResultSet;

class News extends AbstractLink
{
    public function detect(&$source)
    {
        $results = new ResultSet();

        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($source);
        $nodes = $domQuery->queryXpath('//div[@id="ires"]//li[@id="newsbox"]//ol/li');

        foreach($nodes as $node) {
            // get link node
            $nodePath = $node->getNodePath();
            $nodePath .= '//a[@class="l"]';
            $link = $domQuery->queryXpath($nodePath)->current();
            if(null === $link) {
                continue; // not a news link
            }
            // create datas
            $result = new NewsResult(array(
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
