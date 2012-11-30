<?php

namespace SearchEngineCrawler\Engine\Link\Builder;

class Google implements BuilderInterface
{
    public function build($keyword, $page, array $options = array())
    {
        return 'http://www.google.fr/search?q=' . urlencode($keyword) . '&ie=utf-8&oe=utf-8';
    }
}
