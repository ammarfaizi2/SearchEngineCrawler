<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\ResultSet\Link;

use Zend\Stdlib\AbstractOptions;

class Extension extends AbstractOptions
{
    protected $sitelinks;

    public function getSitelinks()
    {
        return $this->sitelinks;
    }

    public function setSitelinks(array $sitelinks)
    {
        $this->sitelinks = $sitelinks;
        return $this;
    }
}
