<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

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
