<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Metadata\Google\Image;

use SearchEngineCrawler\Engine\Metadata\AbstractMetadata;

class Suggest extends AbstractMetadata
{
    public function find()
    {
        $nodes = $this->xpath('//span[@id="prs"]//span[@class="pr"]//a/span');
        $suggest = array();
        foreach($nodes as $node) {
            $suggest[] = $node->textContent;
        }
        $this->metadata = $suggest;
    }
}
