<?php

namespace SearchEngineCrawler\Engine\Link;

use Zend\ServiceManager\AbstractPluginManager;

class LinkPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'googlewebnatural'    => 'SearchEngineCrawler\Engine\Link\Google\Web\Natural',
        'googlewebimage'      => 'SearchEngineCrawler\Engine\Link\Google\Web\Image',
        'googlewebvideo'      => 'SearchEngineCrawler\Engine\Link\Google\Web\Video',
        // TODO
        //'googlewebproduct'      => 'SearchEngineCrawler\Engine\Link\Google\Web\Product',
        //'googlewebmaps'      => 'SearchEngineCrawler\Engine\Link\Google\Web\Maps',
        //'googlewebnews'      => 'SearchEngineCrawler\Engine\Link\Google\Web\News',
        //'googlewebshopping'      => 'SearchEngineCrawler\Engine\Link\Google\Web\Shopping',
        //'googlewebpremium'      => 'SearchEngineCrawler\Engine\Link\Google\Web\Premium',
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