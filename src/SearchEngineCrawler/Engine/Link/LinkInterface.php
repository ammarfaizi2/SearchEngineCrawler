<?php

namespace SearchEngineCrawler\Engine\Link;

interface LinkInterface
{
    /**
     * 
     * @return array : array of arrays, position => ads
     */
    public function detect(&$source);
}