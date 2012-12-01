<?php

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
