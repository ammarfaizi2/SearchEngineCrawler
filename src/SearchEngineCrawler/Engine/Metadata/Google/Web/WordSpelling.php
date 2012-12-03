<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Metadata\Google\Web;

use SearchEngineCrawler\Engine\Metadata\AbstractMetadata;

class WordSpelling extends AbstractMetadata
{
    public function find()
    {
        $node = $this->xpath('//a[@class="spell"]')->current();
        if(null === $node) {
            return;
        }
        $this->metadata = trim($node->textContent);
    }
}
