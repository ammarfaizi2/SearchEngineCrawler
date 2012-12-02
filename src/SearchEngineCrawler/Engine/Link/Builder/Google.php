<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link\Builder;

use Zend\Validator\Hostname;
use Zend\Stdlib\Exception\InvalidArgumentException;

class Google extends AbstractBuilder
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

    protected function buildLinkWithOptions()
    {
        $params = '';
        $options = $this->getOptions();

        // add start
        $params .= sprintf('&start=%s', ($options->getNumPerPage() * ($options->getPage()-1)));
        // add num per page
        $params .= sprintf('&num=%s&complete=0', $options->getNumPerPage());
        // add language
        if($options->getLang()) {
            $params .= sprintf('&gl=%s', $options->getLang());
        }

        $keyword = urlencode(htmlspecialchars_decode(stripslashes($options->getKeyword())));
        $uri = sprintf(
            'http://%s/search?q=%s&ie=utf-8&oe=utf-8&pws=%s',
            $options->getHost(), $keyword, $params
        );

        return $uri;
    }
}
