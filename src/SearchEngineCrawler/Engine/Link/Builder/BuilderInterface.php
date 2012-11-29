<?php

namespace SearchEngineCrawler\Engine\Link\Builder;

interface BuilderInterface
{
    public function build($keyword, $page, array $options = array());
}