<?php

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeLinkAnchorProviderInterface
{
    /**
     * Get the link anchor
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeLinkAnchor(\DOMElement $node);
}
