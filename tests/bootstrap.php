<?php

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