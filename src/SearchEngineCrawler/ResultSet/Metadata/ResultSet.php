<?php

namespace SearchEngineCrawler\ResultSet\Metadata;

use ArrayObject;
use SearchEngineCrawler\Engine\Metadata\MetadataInterface;

class ResultSet extends ArrayObject
{
    public function addMetadata(MetadataInterface $metadata)
    {
        $class = get_class($metadata);
        $name = substr($class, strrpos($class, '\\')+1);
        $name = strtolower($name);
        $this->offsetSet($name, $metadata->getMetadata());
        return $this;
    }

    public function __call($name, $arguments)
    {
        if(!preg_match('#^get#', $name)) {
            return parent::__call($name, $arguments);
        }
        $name = preg_replace('#^get#', '', $name);
        $name = strtolower($name);
        if(!$this->offsetExists($name)) {
            return parent::__call($name, $arguments);
        }
        return $this->offsetGet($name);
    }
}
