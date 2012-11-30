<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Result\Product as ProductResult;
use SearchEngineCrawler\ResultSet\Link\ResultSet;

class Product extends AbstractLink
{
    public function detect(&$source)
    {
        $results = new ResultSet();

        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($source);
        $nodes = $domQuery->queryXpath('//div[@id="ires"]//li[@id="productbox"]//td[@class="pcr"]/div');

        foreach($nodes as $node) {
            // get image node
            $nodePath = $node->getNodePath();
            $nodePath .= '/a';
            $link = $domQuery->queryXpath($nodePath)->current();
            if(null === $link) {
                continue; // not a product link
            }
            // create datas
            $result = new ProductResult(array(
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
