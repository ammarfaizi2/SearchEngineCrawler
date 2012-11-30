<?php

namespace SearchEngineCrawler\Engine\Link;

interface LinkInterface
{
    public function detect(&$source);
}
