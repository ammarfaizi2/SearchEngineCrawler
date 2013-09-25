<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Metadata\Google\Image;

use SearchEngineCrawler\Engine\Metadata\AbstractMetadata;

class Suggest extends AbstractMetadata
{
    public function find()
    {
        $nodes = $this->xpath('//div[@id="topstuff"]/div[@class="tqref"]//a');
        $suggest = array();
        foreach($nodes as $node) {
            $suggest[] = $node->textContent;
        }
        $this->metadata = $suggest;
    }
}
