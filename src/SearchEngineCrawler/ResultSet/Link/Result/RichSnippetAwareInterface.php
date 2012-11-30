<?php

namespace SearchEngineCrawler\ResultSet\Link\Result;

use SearchEngineCrawler\ResultSet\Link\RichSnippet;

interface RichSnippetAwareInterface
{
    public function getRichsnippet();
    public function setRichsnippet(RichSnippet $richSnippet);
}
