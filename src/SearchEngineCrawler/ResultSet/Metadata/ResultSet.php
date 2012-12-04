<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

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
            return null;
        }
        $name = preg_replace('#^get#', '', $name);
        $name = strtolower($name);
        if(!$this->offsetExists($name)) {
            return null;
        }
        return $this->offsetGet($name);
    }
}
