<?php

namespace SearchEngineCrawler\ResultSet\Link;

use Zend\Stdlib\AbstractOptions;

class Extension extends AbstractOptions
{
    protected $sitelinks;

    public function getSitelinks()
    {
        return $this->sitelinks;
    }

    public function setSitelinks($sitelinks)
    {
        $this->sitelinks = $sitelinks;
        return $this;
    }
}
