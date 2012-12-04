<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Crawler\Match;

use Zend\Stdlib\AbstractOptions;

class Options extends AbstractOptions
{
    protected $strictMode = true;

    protected $strictDns = true;

    public function getStrictMode()
    {
        return $this->strictMode;
    }

    public function setStrictMode($strictMode)
    {
        $this->strictMode = (boolean)$strictMode;
        return $this;
    }

    public function getStrictDns()
    {
        return $this->strictDns;
    }

    public function setStrictDns($strictDns)
    {
        $this->strictDns = (boolean)$strictDns;
        return $this;
    }
}
