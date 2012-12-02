<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine;

interface EngineInterface
{
    /**
     * Crawl list of results
     * @param string $keyword the keyword to parse
     * @param array $options parser & link builder options
     */
    public function crawl($keyword = null, array $options = array());
}
