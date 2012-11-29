<?php

namespace SearchEngineCrawler\Engine\Link\Builder;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\View\HelperPluginManager;
use Zend\Stdlib\Exception\LogicException;

class LinkBuilderManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'google'    => 'SearchEngineCrawler\Engine\Link\Builder\Google',
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