<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeSourceProviderInterface
{
    /**
     * Get the source
     * @param \DOMElement $node
     * @return string the source
     */
    public function getNodeSource(\DOMElement $node);
}
