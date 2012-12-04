<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
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

    /**
     * Match uri with the list of results
     * @param string $keyword the keyword to parse
     * @param string $match uri/array of uri to parse
     * @param array $options parser & link builder options
     */
    public function match($keyword = null, $match = null, array $options = array());
}
