<?php

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeMapProviderInterface
{
    /**
     * Get the node address
     * @param \DOMElement $node
     * @return string the address
     */
    public function getNodeAddress(\DOMElement $node);

    /**
     * Get the node map link
     * @param \DOMElement $node
     * @return string the link
     */
    public function getNodeMapLink(\DOMElement $node);
}
