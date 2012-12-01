<?php

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeAdProviderInterface
{
    /**
     * Get the ad
     * @param \DOMElement $node
     * @return string the node ad
     */
    public function getNodeAd(\DOMElement $node);
}
