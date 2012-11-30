<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Result\Premium as PremiumResult;
use SearchEngineCrawler\ResultSet\Link\ResultSet;

class Premium extends AbstractLink
{
    public function detect(&$source)
    {
        $results = new ResultSet();

        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($source);
        $nodes = $domQuery->queryXpath('//div[@id="tads"]/ol/li');
        foreach($nodes as $node) {
            // get link node
            $nodePath = $node->getNodePath();
            $nodePath .= '/div/h3/a';
            $link = $domQuery->queryXpath($nodePath)->current();
            if(null === $link) {
                continue; // not a natural link
            }
            // create datas
            $result = new PremiumResult(array(
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
