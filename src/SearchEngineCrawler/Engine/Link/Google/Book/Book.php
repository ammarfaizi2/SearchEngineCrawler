<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Link\Google\Book;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\Engine\Link\Features;

class Book extends AbstractLink implements Features\NodeLinkAnchorProviderInterface,
    Features\NodeImageSourceProviderInterface, Features\NodeAuthorProviderInterface,
    Features\NodeDateProviderInterface
{
    /**
     * Result class container
     * @var string
     */
    protected $resultClass = 'SearchEngineCrawler\ResultSet\Link\Result\Book';

    /**
     * Get the node list, each node contains
     * the ad & line number
     * @return Zend\Dom\NodeList
     */
    public function getNodeList()
    {
        return $this->xpath('//ol[@id="rso"]//li[@class="g"]');
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
        $nodePath .= '//h3[@class="r"]/a';
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
     * Get the link anchor
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeImageSource(\DOMElement $node)
    {
        $nodePath = $node->getNodePath();
        $nodePath .= '//img[starts-with(@id,"bksthumb")]';
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
    public function getNodeAuthor(\DOMElement $node)
    {
        $nodePath = $node->getNodePath();
        $nodePath .= '//div[@class="f"]/a[contains(@href,"=inauthor:")]';
        $authors = array();
        $links = $this->xpath($nodePath);
        foreach($links as $link) {
            $authors[] = $link->textContent;
        }
        return $authors;
    }

    /**
     * Get date (from book publishing by exemple)
     * @param \DOMElement $node
     * @return string a date
     */
    public function getNodeDate(\DOMElement $node)
    {
        $nodePath = $node->getNodePath();
        $nodePath .= '//div[@class="f"]';
        $links = $this->xpath($nodePath)->current();
        preg_match('# (?P<date>(1|2)\d{3}) #', $links->textContent, $regs);
        if(!isset($regs['date'])) {
            return null;
        }
        return $regs['date'];
    }
}
