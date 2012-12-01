<?php

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeImageSourceProviderInterface
{
    /**
     * Get the link anchor
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeImageSource(\DOMElement $node);
}
