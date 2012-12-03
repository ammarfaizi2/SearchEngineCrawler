<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link;

use Zend\ServiceManager\AbstractPluginManager;

class LinkPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        // google web
        'googlewebnatural'          => 'SearchEngineCrawler\Engine\Link\Google\Web\Natural',
        'googlewebimage'            => 'SearchEngineCrawler\Engine\Link\Google\Web\Image',
        'googlewebvideo'            => 'SearchEngineCrawler\Engine\Link\Google\Web\Video',
        'googlewebproduct'          => 'SearchEngineCrawler\Engine\Link\Google\Web\Product',
        'googlewebpremium'          => 'SearchEngineCrawler\Engine\Link\Google\Web\Premium',
        'googlewebpremiumbottom'    => 'SearchEngineCrawler\Engine\Link\Google\Web\PremiumBottom',
        'googlewebmap'              => 'SearchEngineCrawler\Engine\Link\Google\Web\Map',
        'googlewebnews'             => 'SearchEngineCrawler\Engine\Link\Google\Web\News',
        // google image
        'googleimageimage'          => 'SearchEngineCrawler\Engine\Link\Google\Image\Image',
        // google video
        'googlevideonatural'        => 'SearchEngineCrawler\Engine\Link\Google\Video\Natural',
        'googlevideovideo'          => 'SearchEngineCrawler\Engine\Link\Google\Video\Video',
    );

    public function validatePlugin($plugin)
    {
        if($plugin instanceof LinkInterface) {
            return;
        }

        throw new LogicException(sprintf(
            'Plugin of type %s is invalid; must implement %s\LinkInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
