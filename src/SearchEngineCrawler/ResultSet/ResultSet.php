<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\ResultSet;

use ArrayObject;
use SearchEngineCrawler\ResultSet\Page\Container as PageContainer;

class ResultSet extends ArrayObject
{
    public function hasPage($num)
    {
        return $this->offsetExists($num);
    }

    public function getPage($num)
    {
        return $this->offsetGet($num);
    }

    public function setPage($num, PageContainer $set)
    {
        $this->offsetSet($num, $set);
        return $this;
    }
}
