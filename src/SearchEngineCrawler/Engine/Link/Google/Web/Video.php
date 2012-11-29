<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Result\Video as VideoResult;
use SearchEngineCrawler\ResultSet\ResultSet;

class Video extends AbstractLink
{
    public function detect(&$source)
    {
        $results = new ResultSet();

        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($source);
        $nodes = $domQuery->queryXpath('//div[@id="ires"]//li[@class="g"]');
        foreach($nodes as $node) {
            // check if link is natural
            if(true) {
                $result = new VideoResult(array(
                    'position' => $node->getLineNo(),
                    'ad' => $node->ownerDocument->saveHtml($node),
                    'link' => 'http://www.ebay.fr',
                ));
                $results->append($result);
            }
        }
        return $results;
    }
}