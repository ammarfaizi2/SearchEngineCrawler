<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeAuthorProviderInterface
{
    /**
     * Get the author(s)
     * @param \DOMElement $node
     * @return array list of authors
     */
    public function getNodeAuthor(\DOMElement $node);
}
