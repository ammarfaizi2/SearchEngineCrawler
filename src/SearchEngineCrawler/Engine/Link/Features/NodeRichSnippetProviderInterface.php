<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeRichSnippetProviderInterface
{
    /**
     * Get rich snippet from a link
     * @param \DOMElement $node
     * @return Extension
     */
    public function getRichSnippet(\DOMElement $node);
}
