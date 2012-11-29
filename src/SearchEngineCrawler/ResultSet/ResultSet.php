<?php

namespace SearchEngineCrawler\ResultSet;

use ArrayObject;

class ResultSet extends ArrayObject
{
    public function merge(ResultSet $set)
    {
        foreach($set as $result) {
            $this->offsetSet($result->getPosition(), $result);
        }
        return $this;
    }

    public function sort()
    {
        $this->ksort();
        $datas = array_values($this->getArrayCopy());
        $this->exchangeArray($datas);
        return $this;
    }
}
