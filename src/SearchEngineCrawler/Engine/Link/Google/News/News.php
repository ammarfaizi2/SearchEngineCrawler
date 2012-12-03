<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link\Google\News;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\Engine\Link\Features;

class News extends AbstractLink implements Features\NodeLinkAnchorProviderInterface,
    Features\NodeImageSourceProviderInterface, Features\NodeSourceProviderInterface,
    Features\NodeDateProviderInterface
{
    /**
     * Result class container
     * @var string
     */
    protected $resultClass = 'SearchEngineCrawler\ResultSet\Link\Result\News';

    /**
     * Get the node list, each node contains
     * the ad & line number
     * @return Zend\Dom\NodeList
     */
    public function getNodeList()
    {
        $list = array();
        $nodes = $this->xpath('//ol[@id="rso"]/li[starts-with(@id,"esc-story-cluster-id")]'); // simple link
        foreach($nodes as $node) {
            $list[] = $node;
        }
        $nodes = $this->xpath('//ol[@id="rso"]/li[starts-with(@id,"esc-story-cluster-id")][1]//div[@class="esc-extension-container"]/div/div'); // link in the first container
        foreach($nodes as $node) {
            $list[] = $node;
        }
        return $list;
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
        $nodePath .= '//span[contains(@class,"news-source")]';
        return $this->xpath($nodePath)->current();
    }

    /**
     * Get the link
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeLink(\DOMElement $node)
    {
        // simple link
        if($node->localName == "li") {
            $nodePath = $node->getNodePath();
            $nodePath .= '//h3[@class="r"]/a[@class="l"]';
            $link = $this->xpath($nodePath)->current();
            return $link->getAttribute('href');
        }
        // link in the first container
        else {
            $nodePath = $node->getNodePath();
            $nodePath .= '//a[@class="news-non-lead-article"]';
            $link = $this->xpath($nodePath)->current();
            if(!$link) {
                echo $this->getNodeAd($node);exit();
            }
            return $link->getAttribute('href');
        }
    }

    /**
     * Get the link anchor
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeLinkAnchor(\DOMElement $node)
    {
        // simple link
        if($node->localName == "li") {
            $nodePath = $node->getNodePath();
            $nodePath .= '//a[@class="l"]';
            $node = $this->xpath($nodePath)->current();
            return $node->textContent;
        }
        // link in the first container
        else {
            $nodePath = $node->getNodePath();
            $nodePath .= '//a[@class="news-non-lead-article"]';
            $node = $this->xpath($nodePath)->current();
            return $node->textContent;
        }
    }

    /**
     * Get the link anchor
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeImageSource(\DOMElement $node)
    {
        $nodePath = $node->getNodePath();
        $nodePath .= '//img[starts-with(@id,"esc-thumbnail-")]';
        $img = $this->xpath($nodePath)->current();
        if(null === $img) {
            return null;
        }
        return $img->getAttribute('src');
    }

    /**
     * Get the author(s)
     * @param \DOMElement $node
     * @return array list of authors
     */
    public function getNodeSource(\DOMElement $node)
    {
        // simple link && link in the first container
        $nodePath = $node->getNodePath();
        $nodePath .= '//span[contains(@class,"news-source")]';
        $source = $this->xpath($nodePath)->current();
        return $source->textContent;
    }

    /**
     * Get date (from book publishing by exemple)
     * @param \DOMElement $node
     * @return string a date
     */
    public function getNodeDate(\DOMElement $node)
    {
        // simple link && link in the first container
        $nodePath = $node->getNodePath();
        $nodePath .= '//span[contains(@class,"nsa")]';
        $date = $this->xpath($nodePath)->current();
        return $date->textContent;
    }
}
