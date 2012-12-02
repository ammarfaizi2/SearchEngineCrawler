<?php

namespace SearchEngineCrawler\Engine\Link\Google\Web;

use SearchEngineCrawler\Engine\Link\AbstractLink;
use SearchEngineCrawler\ResultSet\Link\RichSnippet;
use SearchEngineCrawler\Engine\Link\Features;

class PremiumBottom extends Premium
{
    /**
     * Result class container
     * @var string
     */
    protected $resultClass = 'SearchEngineCrawler\ResultSet\Link\Result\PremiumBottom';

    /**
     * Get the node list, each node contains
     * the ad & line number
     * @return Zend\Dom\NodeList
     */
    public function getNodeList()
    {
        return $this->xpath('//div[@id="tadsb"]/ol/li');
    }
}
