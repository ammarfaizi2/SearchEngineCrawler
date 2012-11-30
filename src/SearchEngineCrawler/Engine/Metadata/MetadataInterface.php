<?php

namespace SearchEngineCrawler\Engine\Metadata;

interface MetadataInterface
{
    public function detect(&$source);
}
