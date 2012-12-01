<?php

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeLineNumberProviderInterface
{
    /**
     * Get the line number
     * @param \DOMElement $node
     * @return integer the line number
     */
    public function getNodeLineNumber(\DOMElement $node);
}
