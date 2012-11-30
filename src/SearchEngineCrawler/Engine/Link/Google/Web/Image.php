<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Result\Image as ImageResult;

class Image extends AbstractLink
{
    public function detect(&$source)
    {
        $nodes = $this->xpath('//div[@id="ires"]//li[@id="imagebox_bigimages"]//ul[@class="rg_ul"]/li');

        foreach($nodes as $node) {
            // get image node
            $nodePath = $node->getNodePath();
            $nodePath .= '/a/img';
            $image = $this->xpath($nodePath)->current();
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
            $this->append($result);
        }
    }
}
