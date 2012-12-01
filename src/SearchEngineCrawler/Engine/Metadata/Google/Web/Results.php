<?php

namespace SearchEngineCrawler\Engine\Metadata\Google\Web;

use SearchEngineCrawler\Engine\Metadata\AbstractMetadata;

class Results extends AbstractMetadata
{
    public function find(&$source)
    {
        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($source);
        $node = $domQuery->queryXpath('//div[@id="resultStats"]')->current();
        if(null === $node || count($node->childNodes) == 2) {
            return;
        }
        $value = $node->childNodes->item(0)->nodeValue;
        $value = preg_replace('#\D#', '', $value);
        $this->metadata = $value;
    }
}
