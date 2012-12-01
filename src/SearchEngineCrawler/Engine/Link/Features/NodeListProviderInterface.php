<?php

namespace SearchEngineCrawler\Engine\Link\Features;

interface NodeListProviderInterface
{
    /**
     * Get the node list, each node contains
     * the ad & line number
     * @return Zend\Dom\NodeList
     */
    public function getNodeList();
}
