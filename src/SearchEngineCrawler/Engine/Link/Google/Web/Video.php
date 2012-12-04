<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\Engine\Link\Features;

class Video extends AbstractLink implements Features\NodeLinkAnchorProviderInterface,
    Features\NodeImageSourceProviderInterface
{
    /**
     * Result class container
     * @var string
     */
    protected $resultClass = 'SearchEngineCrawler\ResultSet\Link\Result\Video';

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
        $nodePath .= '//img[starts-with(@id,"vidthumb")]';
        return $this->xpath($nodePath)->current();
    }

    /**
     * Get the link
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeLink(\DOMElement $node)
    {
        $nodePath = $node->getNodePath();
        $nodePath .= '/div[@class="vsc"]//h3[@class="r"]/a[@class="l"]';
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
        $nodePath = $node->getNodePath();
        $nodePath .= '/div[@class="vsc"]//h3[@class="r"]/a[@class="l"]';
        $link = $this->xpath($nodePath)->current();
        return $node->textContent;
    }

    /**
     * Get the link anchor
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeImageSource(\DOMElement $node)
    {
        $nodePath = $node->getNodePath();
        $nodePath .= '//img[starts-with(@id,"vidthumb")]';
        $link = $this->xpath($nodePath)->current();
        return $node->getAttribute('src');
    }
}
