<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Result\Natural as NaturalResult;
use SearchEngineCrawler\ResultSet\Link\Extension;

class Natural extends AbstractLink
{
    public function detect(&$source)
    {
        $nodes = $this->xpath('//div[@id="ires"]//li[@class="g"]');
        foreach($nodes as $node) {
            // get link node
            $nodePath = $node->getNodePath();
            $nodePath .= '/div[@class="vsc"]/h3[@class="r"]/a[@class="l"]';
            $link = $this->xpath($nodePath)->current();
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
            // get sitelinks
            $result->extension = $this->getExtension($node);
            // append the result
            $this->append($result);
        }
    }

    /**
     * Get extension from a natural link
     * @param \DOMElement $node
     * @return Extension
     */
    protected function getExtension(\DOMElement $node)
    {
        // get sitelinks extension
        $sitelinks = array();
        $nodePath = $node->getNodePath();
        $nodePath .= '/div[@class="vsc"]/div[@class="s"]/div[@class="osl"]/a';
        $links = $this->xpath($nodePath);
        foreach($links as $link) {
            $sitelinks[] = array(
                'link' => $link->getAttribute('href'),
                'content' => $link->textContent,
            );
        }

        return new Extension(array('sitelinks' => $sitelinks));
    }
}
