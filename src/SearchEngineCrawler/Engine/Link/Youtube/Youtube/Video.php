<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Link\Youtube\Youtube;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\Engine\Link\Features;

class Video extends AbstractLink implements Features\NodeLinkAnchorProviderInterface,
    Features\NodeImageSourceProviderInterface, Features\NodeAuthorProviderInterface,
    Features\NodeViewNumberProviderInterface
{
    /**
     * Result class container
     * @var string
     */
    protected $resultClass = 'SearchEngineCrawler\ResultSet\Link\Result\Video\Youtube';

    /**
     * Get the node list, each node contains
     * the ad & line number
     * @return Zend\Dom\NodeList
     */
    public function getNodeList()
    {
        return $this->xpath('//ol[@id="search-results"]/li');
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
        $nodePath .= '//a[contains(@href,"/watch?v=")]';
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
        $nodePath .= '//a[contains(@class,"yt-uix-tile-link")]';
        $link = $this->xpath($nodePath)->current();
        $href = $link->getAttribute('href');
        if(preg_match('#^/#', $href)) {
            $href = 'http://www.youtube.com' . $href;
        }
        return $href;
    }

    /**
     * Get the link anchor
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeLinkAnchor(\DOMElement $node)
    {
        $nodePath = $node->getNodePath();
        $nodePath .= '//a[contains(@class,"yt-uix-tile-link")]';
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
        $nodePath .= '//span[@class="yt-thumb-clip-inner"]/img';
        $link = $this->xpath($nodePath)->current();
        return $node->getAttribute('src');
    }

    /**
     * Get the author(s)
     * @param \DOMElement $node
     * @return array list of authors
     */
    public function getNodeAuthor(\DOMElement $node)
    {
        $nodePath = $node->getNodePath();
        $nodePath .= '//a[contains(@class,"yt-uix-sessionlink yt-user-name")]';
        $link = $this->xpath($nodePath)->current();
        return $node->textContent;
    }

    /**
     * Get the view number of a result
     * @param \DOMElement $node
     * @return string the number
     */
    public function getNodeViewNumber(\DOMElement $node)
    {
        $number = $node->getAttribute('data-context-item-views');
        $number = preg_replace('#\D#', '', $number);
        return $number;
    }
}
