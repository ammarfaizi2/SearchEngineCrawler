<?php

namespace SearchEngineCrawler\Engine\Link;

use Zend\ServiceManager\AbstractPluginManager;

class LinkPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'googlewebnatural'    => 'SearchEngineCrawler\Engine\Link\Google\Web\Natural',
        'googlewebimage'      => 'SearchEngineCrawler\Engine\Link\Google\Web\Image',
        'googlewebvideo'      => 'SearchEngineCrawler\Engine\Link\Google\Web\Video',
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