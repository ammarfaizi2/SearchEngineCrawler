<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

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
