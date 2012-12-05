<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Link\Google\Shopping;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\Engine\Link\Features;
use SearchEngineCrawler\ResultSet\Link\Extension;
use SearchEngineCrawler\ResultSet\Link\RichSnippet;

class Premium extends AbstractLink implements Features\NodeLinkAnchorProviderInterface,
    Features\NodeRichSnippetProviderInterface, Features\NodeExtensionProviderInterface
{
    /**
     * Result class container
     * @var string
     */
    protected $resultClass = 'SearchEngineCrawler\ResultSet\Link\Result\Premium';

    /**
     * Get the node list, each node contains
     * the ad & line number
     * @return Zend\Dom\NodeList
     */
    public function getNodeList()
    {
        return $this->xpath('//div[@id="tads"]/ol/li');
    }

    /**
     * Check if a node is valid, if the node match with the type required
     * If node is valid, return the node
     * @param \DOMElement $node node to validate
     * @return null|\DOMElement
     */
    public function validateNode(\DOMElement $node)
    {
        $nodePath = $node->getNodePath();
        $nodePath .= '/h3/a';
        return $this->xpath($nodePath)->current();
    }

    /**
     * Get the link
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeLink(\DOMElement $node)
    {
        $node = $this->validateNode($node);
        return $node->getAttribute('href');
    }

    /**
     * Get the link anchor
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeLinkAnchor(\DOMElement $node)
    {
        $node = $this->validateNode($node);
        return $node->textContent;
    }

    /**
     * Get rich snippets from a natural link
     * @param \DOMElement $node
     * @return Extension
     */
    public function getNodeRichSnippet(\DOMElement $node)
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

    /**
     * Get extension link
     * @param \DOMElement $node
     * @return Extension
     */
    public function getNodeExtension(\DOMElement $node)
    {
        // get sitelinks extension
        $sitelinks = array();
        $nodePath = $node->getNodePath();
        $nodePath .= '//div[@class="oslk"]/a';
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
