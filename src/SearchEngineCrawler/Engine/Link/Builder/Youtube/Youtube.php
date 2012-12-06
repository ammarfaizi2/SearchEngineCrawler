<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Link\Builder\Youtube;

use SearchEngineCrawler\Engine\Link\Builder\AbstractBuilder;
use SearchEngineCrawler\Engine\Link\Builder\Options;

class Youtube extends AbstractBuilder
{
    const LANG_EN = 'en';
    const LANG_FR = 'fr';

    public function __construct()
    {
        // default options
        $options = new Options(array(
            'host' => 'www.youtube.com',
            'lang' => self::LANG_EN,
        ));
        $this->setOptions($options);
    }

    protected function buildLinkWithOptions()
    {
        $params = '';
        $options = $this->getOptions();

        // add start
        $params .= sprintf('&page=%s', $options->getPage());
        // add language
        if($options->getLang()) {
            $params .= sprintf('&hl=%s', $options->getLang());
        }

        $keyword = urlencode(htmlspecialchars_decode(stripslashes($options->getKeyword())));
        $uri = sprintf(
            'http://%s/results?search_query=%s%s',
            $options->getHost(), $keyword, $params
        );

        return $uri;
    }
}
