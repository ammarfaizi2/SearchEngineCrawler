<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Metadata\Google\News;

use SearchEngineCrawler\Engine\Metadata\AbstractMetadata;

class Results extends AbstractMetadata
{
    public function find()
    {
        $node = $this->xpath('//div[@id="resultStats"]')->current();
        if(null === $node || count($node->childNodes) == 2) {
            return;
        }
        $value = $node->childNodes->item(0)->nodeValue;
        $value = preg_replace('#\D#', '', $value);
        $this->metadata = $value;
    }
}
