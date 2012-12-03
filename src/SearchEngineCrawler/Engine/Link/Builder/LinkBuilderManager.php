<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link\Builder;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\View\HelperPluginManager;
use Zend\Stdlib\Exception\LogicException;

class LinkBuilderManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'googleweb'     => 'SearchEngineCrawler\Engine\Link\Builder\Google\Web',
        'googleimage'   => 'SearchEngineCrawler\Engine\Link\Builder\Google\Image',
        'googlevideo'   => 'SearchEngineCrawler\Engine\Link\Builder\Google\Video',
        'googlebook'    => 'SearchEngineCrawler\Engine\Link\Builder\Google\Book',
        'googlenews'    => 'SearchEngineCrawler\Engine\Link\Builder\Google\News',
    );

    public function validatePlugin($plugin)
    {
        if($plugin instanceof BuilderInterface) {
            return;
        }

        throw new LogicException(sprintf(
            'Plugin of type %s is invalid; must implement %s\BuilderInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
