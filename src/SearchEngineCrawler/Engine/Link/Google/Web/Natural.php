<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\Extension;
use SearchEngineCrawler\Engine\Link\Features;

class Natural extends AbstractLink implements Features\NodeLinkAnchorProviderInterface,
    Features\NodeExtensionProviderInterface
{
    /**
     * Result class container
     * @var string
     */
    protected $resultClass = 'SearchEngineCrawler\ResultSet\Link\Result\Natural';

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
        // natural have never style
        if($node->hasAttribute('style')) {
            return null;
        }
        // natural have only 2 div
        $nodePath = $node->getNodePath();
        $nodePath .= '/div[@class="vsc"]/div';
        if($this->xpath($nodePath)->count() != 2) {
            return null;
        }
        // natural must be have link
        $nodePath = $node->getNodePath();
        $nodePath .= '/div[@class="vsc"]/h3[@class="r"]/a[@class="l"]';
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
     * Get extension from a natural link
     * @param \DOMElement $node
     * @return Extension
     */
    public function getExtension(\DOMElement $node)
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
