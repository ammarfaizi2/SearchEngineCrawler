<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\Engine\Link\Features;

class Map extends AbstractLink implements Features\NodeLinkAnchorProviderInterface,
    Features\NodeMapProviderInterface
{
    /**
     * Result class container
     * @var string
     */
    protected $resultClass = 'SearchEngineCrawler\ResultSet\Link\Result\Map';

    /**
     * Get the node list, each node contains
     * the ad & line number
     * @return Zend\Dom\NodeList
     */
    public function getNodeList()
    {
        return $this->xpath('//div[@id="ires"]//li[@class="g"]');
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
        $nodePath .= '/div[contains(@data-extra, "lumarker")]';
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
        $nodePath = $node->getNodePath();
        $nodePath .= '/h3[@class="r"]/a[@class="l"]';
        $link = $this->xpath($nodePath)->current();
        return $link->getAttribute('href');
    }

    /**
     * Get the link anchor
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeLinkAnchor(\DOMElement $node)
    {
        $node = $this->validateNode($node);
        $nodePath = $node->getNodePath();
        $nodePath .= '/h3[@class="r"]/a[@class="l"]';
        $link = $this->xpath($nodePath)->current();
        return $link->textContent;
    }

    /**
     * Get the node address
     * @param \DOMElement $node
     * @return string the address
     */
    public function getNodeAddress(\DOMElement $node)
    {
        $node = $this->validateNode($node);
        $nodePath = $node->getNodePath();
        $nodePath .= '//table[contains(@class, "intrlu")]//td';
        $node = $this->xpath($nodePath);
        $address = $node->next();
        return $address->textContent;
    }

    /**
     * Get the node map link
     * @param \DOMElement $node
     * @return string the link
     */
    public function getNodeMapLink(\DOMElement $node)
    {
        $node = $this->validateNode($node);
        $nodePath = $node->getNodePath();
        $nodePath .= '//table[contains(@class, "intrlu")]//td//a';
        $node = $this->xpath($nodePath);
        $map = $node->current();
        return $map->getAttribute('href');
    }
}
