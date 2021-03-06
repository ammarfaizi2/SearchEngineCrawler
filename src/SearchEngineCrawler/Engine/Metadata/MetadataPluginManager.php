<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Metadata;

use Zend\ServiceManager\AbstractPluginManager;

class MetadataPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'googlewebresults'          => 'SearchEngineCrawler\Engine\Metadata\Google\Web\Results',
        'googlewebwordspelling'     => 'SearchEngineCrawler\Engine\Metadata\Google\Web\WordSpelling',
        'googlewebsuggest'          => 'SearchEngineCrawler\Engine\Metadata\Google\Web\Suggest',
        'googleimagesuggest'        => 'SearchEngineCrawler\Engine\Metadata\Google\Image\Suggest',
        'googlevideoresults'        => 'SearchEngineCrawler\Engine\Metadata\Google\Video\Results',
        'googlebookresults'         => 'SearchEngineCrawler\Engine\Metadata\Google\Book\Results',
        'googlenewsresults'         => 'SearchEngineCrawler\Engine\Metadata\Google\News\Results',
        'googleshoppingresults'     => 'SearchEngineCrawler\Engine\Metadata\Google\Shopping\Results',
        'googleshoppingsuggest'     => 'SearchEngineCrawler\Engine\Metadata\Google\Shopping\Suggest',
    );

    public function validatePlugin($plugin)
    {
        if($plugin instanceof MetadataInterface) {
            return;
        }

        throw new LogicException(sprintf(
            'Plugin of type %s is invalid; must implement %s\MetadataInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
