<?php

namespace SearchEngineCrawler\Engine\Metadata;

use Zend\ServiceManager\AbstractPluginManager;

class MetadataPluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        'googlewebresults'         => 'SearchEngineCrawler\Engine\Metadata\Google\Web\Results',
        'googlewebwordspelling'    => 'SearchEngineCrawler\Engine\Metadata\Google\Web\WordSpelling',
        // TODO
        //'googlewebsuggest'    => 'SearchEngineCrawler\Engine\Metadata\Google\Web\Suggest',
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
