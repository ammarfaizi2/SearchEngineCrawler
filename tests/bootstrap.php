<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

ini_set('date.timezone',"Europe/Paris");
include __DIR__ . '/_autoload.php';

/**
 * Define if you want crawl in live or use test files cached
 */
define('CRAWL_IN_LIVE', false);

/**
 * Define if you want update the file tests if you crawl in live
 */
define('CRAWL_UPDATE_CACHE', false);