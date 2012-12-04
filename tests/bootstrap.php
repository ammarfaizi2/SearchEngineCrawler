<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

ini_set('date.timezone',"Europe/Paris");
include __DIR__ . '/_autoload.php';

/**
 * Define if you want crawl in live or use test files cached
 */
define('CRAWL_IN_LIVE', false);

/**
 * Define if you want crawl paginator, have no cache
 */
define('CRAWL_PAGINATOR', false);

/**
 * Define if you want update the file tests if you crawl in live
 */
define('CRAWL_UPDATE_CACHE', false);