<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Result\Image as ImageResult;
use SearchEngineCrawler\ResultSet\Link\ResultSet;

class Image extends AbstractLink
{
    public function detect(&$source)
    {
        $results = new ResultSet();

        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($source);
        $nodes = $domQuery->queryXpath('//div[@id="ires"]//li[@id="imagebox_bigimages"]//ul[@class="rg_ul"]/li');

        foreach($nodes as $node) {
            // get image node
            $nodePath = $node->getNodePath();
            $nodePath .= '/a/img';
            $image = $domQuery->queryXpath($nodePath)->current();
            if(null === $image) {
                continue; // not a image link
            }
            $link = $image->parentNode;
            // create datas
            $result = new ImageResult(array(
                'position' => $node->getLineNo(),
                'ad' => $node->ownerDocument->saveHtml($node),
                'link' => $link->getAttribute('href'),
                'image' => $image->getAttribute('src'),
            ));
            $results->append($result);
        }
        return $results;
    }
}
