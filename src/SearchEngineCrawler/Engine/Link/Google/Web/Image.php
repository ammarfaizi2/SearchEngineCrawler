<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Result\Image as ImageResult;
use SearchEngineCrawler\ResultSet\ResultSet;

class Image extends AbstractLink
{
    public function detect(&$source)
    {
        $results = new ResultSet();

        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($source);
        $nodes = $domQuery->queryXpath('//div[@id="ires"]//li[@id="imagebox_bigimages"]//ul[@class="rg_ul"]/li');
        foreach($nodes as $node) {
            $result = new ImageResult(array(
                'position' => $node->getLineNo(),
                'ad' => $node->ownerDocument->saveHtml($node),
                'link' => 'http://www.ebay.fr',
            ));
            $results->append($result);
        }
        return $results;
    }
}