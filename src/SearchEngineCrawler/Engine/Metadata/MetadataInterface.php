<?php

namespace SearchEngineCrawler\Engine\Metadata;

interface MetadataInterface
{
    public function find(&$source);

    public function getMetadata();
}
