<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Google;

use SearchEngineCrawler\Engine\AbstractEngine;

class News extends AbstractEngine
{
    protected $builderClass = 'SearchEngineCrawler\Engine\Link\Builder\Google\News';

    protected $defaultLinks = array('news');
}
