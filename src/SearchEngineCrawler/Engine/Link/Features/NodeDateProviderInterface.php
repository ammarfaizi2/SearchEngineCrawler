<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeDateProviderInterface
{
    /**
     * Get date (from book publishing by exemple)
     * @param \DOMElement $node
     * @return string a date
     */
    public function getNodeDate(\DOMElement $node);
}
