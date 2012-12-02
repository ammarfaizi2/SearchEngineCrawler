<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
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
