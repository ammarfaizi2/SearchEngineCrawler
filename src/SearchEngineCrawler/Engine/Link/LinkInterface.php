<?php

namespace SearchEngineCrawler\Engine\Link;

interface LinkInterface
{
    /**
     * Method to detect links, initial method
     * @param string $source html code source
     */
    public function detect(&$source);

    /**
     * Check if a node is valid, if the node match with the type required
     * If node is valid, return the node
     * @param \DOMElement $node node to validate
     * @return null|\DOMElement
     */
    public function validateNode(\DOMElement $node);
}
