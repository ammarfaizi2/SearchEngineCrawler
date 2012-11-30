<?php

namespace SearchEngineCrawler\Engine\Metadata\Google\Web;

use SearchEngineCrawler\Engine\Metadata\AbstractMetadata;

class Suggest extends AbstractMetadata
{
    public function find(&$source)
    {
        $domQuery = $this->getDomQuery();
        $domQuery->setDocumentHtml($source);
        $nodes = $domQuery->queryXpath('//div[@id="brs"]/div[@class="brs_col"]//a');
        $suggest = array();
        foreach($nodes as $node) {
            $suggest[] = $node->textContent;
        }
        $this->metadata = $suggest;
    }
}
