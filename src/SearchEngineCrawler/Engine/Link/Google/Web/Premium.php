<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Result\Premium as PremiumResult;
use SearchEngineCrawler\ResultSet\Link\RichSnippet;

class Premium extends AbstractLink
{
    public function detect(&$source)
    {
        $nodes = $this->xpath('//div[@id="tads"]/ol/li');
        foreach($nodes as $node) {
            // get link node
            $nodePath = $node->getNodePath();
            $nodePath .= '/div/h3/a';
            $link = $this->xpath($nodePath)->current();
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
            // get sitelinks
            $result->richsnippet = $this->getRichSnippet($node);
            // append the result
            $this->append($result);
        }
    }

    /**
     * Get rich snippets from a natural link
     * @param \DOMElement $node
     * @return Extension
     */
    public function getRichSnippet(\DOMElement $node)
    {
        // get products snippet
        $products = array();
        $nodePath = $node->getNodePath();
        $nodePath .= '/div[contains(@class,"vsc")]//table[@class="ts"]//tr';
        $links = $this->xpath($nodePath);
        foreach($links as $link) {
            $childs = $link->childNodes;
            $products[] = array(
                'link' => $childs->item(0)->firstChild->getAttribute('href'),
                'content' => $childs->item(0)->firstChild->textContent,
                'price' => (float)preg_replace("#[^\d\.\,]#", '', strtr($childs->item(2)->textContent, ',', '.')),
            );
        }

        return new RichSnippet(array('products' => $products));
    }
}
