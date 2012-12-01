<?php

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeLinkProviderInterface
{
    /**
     * Get the link
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeLink(\DOMElement $node);
}
