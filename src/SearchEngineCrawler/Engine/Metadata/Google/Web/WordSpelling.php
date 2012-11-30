<?php

namespace SearchEngineCrawler\Engine\Metadata\Google\Web;

use SearchEngineCrawler\Engine\Metadata\AbstractMetadata;

class WordSpelling extends AbstractMetadata
{
    public function find(&$source)
    {
        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($source);
        $node = $domQuery->queryXpath('//a[@class="spell"]')->current();
        if(null === $node) {
            return;
        }
        $this->metadata = trim($node->textContent);
    }
}
