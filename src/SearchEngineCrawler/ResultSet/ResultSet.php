<?php

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
