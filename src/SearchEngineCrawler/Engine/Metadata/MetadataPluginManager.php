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
        // google web
        'googlewebresults'         => 'SearchEngineCrawler\Engine\Metadata\Google\Web\Results',
        'googlewebwordspelling'    => 'SearchEngineCrawler\Engine\Metadata\Google\Web\WordSpelling',
        'googlewebsuggest'         => 'SearchEngineCrawler\Engine\Metadata\Google\Web\Suggest',
        // gogle image
        'googleimagesuggest'         => 'SearchEngineCrawler\Engine\Metadata\Google\Image\Suggest',
        // gogle video
        'googlevideoresults'         => 'SearchEngineCrawler\Engine\Metadata\Google\Video\Results',
        // gogle book
        'googlebookresults'         => 'SearchEngineCrawler\Engine\Metadata\Google\Book\Results',
        // gogle news
        'googlenewsresults'         => 'SearchEngineCrawler\Engine\Metadata\Google\News\Results',
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
