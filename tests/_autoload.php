<?php

require_once __DIR__ . '/../../zf2/library/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true,
        'namespaces' => array(
            'SearchEngineCrawler' => __DIR__ . '/../src/SearchEngineCrawler',
            'SearchEngineCrawlerTest' => __DIR__ . '/SearchEngineCrawler',
        ),
    ),
));