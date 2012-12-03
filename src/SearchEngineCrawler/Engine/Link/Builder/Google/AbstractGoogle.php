<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link\Builder\Google;

use SearchEngineCrawler\Engine\Link\Builder\AbstractBuilder;
use SearchEngineCrawler\Engine\Link\Builder\Options;

abstract class AbstractGoogle extends AbstractBuilder
{
    const HOST_COM = 'www.google.com';
    const HOST_FR = 'www.google.fr';
    const HOST_BE = 'www.google.be';
    const HOST_ES = 'www.google.es';
    const HOST_IT = 'www.google.it';
    const HOST_UK = 'www.google.co.uk';
    const HOST_DE = 'www.google.de';
    const HOST_AT = 'www.google.at';
    const HOST_RO = 'www.google.ro';
    const HOST_CA = 'www.google.ca';
    const HOST_NL = 'www.google.nl';
    const HOST_RU = 'www.google.ru';
    const HOST_LU = 'www.google.lu';
    const HOST_AU = 'www.google.com.au';
    const HOST_PL = 'www.google.pl';

    const LANG_EN = 'en';
    const LANG_FR = 'fr';

    public function __construct()
    {
        // default options
        $options = new Options(array(
            'host' => self::HOST_COM,
            'lang' => self::LANG_EN,
            'num_per_page' => 10,
        ));
        $this->setOptions($options);
    }
}
