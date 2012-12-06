<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Link;

use Zend\ServiceManager\AbstractPluginManager;

class LinkPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        // google web
        'googlewebnatural'              => 'SearchEngineCrawler\Engine\Link\Google\Web\Natural',
        'googlewebimage'                => 'SearchEngineCrawler\Engine\Link\Google\Web\Image',
        'googlewebvideo'                => 'SearchEngineCrawler\Engine\Link\Google\Web\Video',
        'googlewebproduct'              => 'SearchEngineCrawler\Engine\Link\Google\Web\Product',
        'googlewebpremium'              => 'SearchEngineCrawler\Engine\Link\Google\Web\Premium',
        'googlewebpremiumbottom'        => 'SearchEngineCrawler\Engine\Link\Google\Web\PremiumBottom',
        'googlewebmap'                  => 'SearchEngineCrawler\Engine\Link\Google\Web\Map',
        'googlewebnews'                 => 'SearchEngineCrawler\Engine\Link\Google\Web\News',
        'googleimageimage'              => 'SearchEngineCrawler\Engine\Link\Google\Image\Image',
        'googlevideonatural'            => 'SearchEngineCrawler\Engine\Link\Google\Video\Natural',
        'googlevideovideo'              => 'SearchEngineCrawler\Engine\Link\Google\Video\Video',
        'googlebookbook'                => 'SearchEngineCrawler\Engine\Link\Google\Book\Book',
        'googlebookpremium'             => 'SearchEngineCrawler\Engine\Link\Google\Book\Premium',
        'googlenewsnews'                => 'SearchEngineCrawler\Engine\Link\Google\News\News',
        'googlenewsimage'               => 'SearchEngineCrawler\Engine\Link\Google\News\Image',
        'googlenewsnatural'             => 'SearchEngineCrawler\Engine\Link\Google\News\Natural',
        'googleshoppingproduct'         => 'SearchEngineCrawler\Engine\Link\Google\Shopping\Product',
        'googleshoppingpremium'         => 'SearchEngineCrawler\Engine\Link\Google\Shopping\Premium',
        'googleshoppingpremiumbottom'   => 'SearchEngineCrawler\Engine\Link\Google\Shopping\PremiumBottom',
        'youtubeyoutubevideo'           => 'SearchEngineCrawler\Engine\Link\Youtube\Youtube\Video',
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
