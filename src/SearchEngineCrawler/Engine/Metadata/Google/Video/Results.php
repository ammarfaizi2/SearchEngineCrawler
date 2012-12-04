<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Metadata\Google\Video;

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
