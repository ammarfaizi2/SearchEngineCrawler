<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Engine\Link\Builder;

use Zend\Validator\Hostname;
use Zend\Stdlib\Exception\InvalidArgumentException;

abstract class AbstractBuilder implements BuilderInterface
{
    /**
     * @var Options
     */
    protected $options;

    public function build(array $options = array())
    {
        $opts = $this->getOptions();
        $opts->setFromArray($options);
        $uri = $this->buildLinkWithOptions();
        return $uri;
    }

    abstract protected function buildLinkWithOptions();

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($options)
    {
        if(is_array($options)) {
            $options = new Options($options);
        }
        if(!$options instanceof $options) {
            throw new InvalidArgumentException('Options must be an array or an Options instance');
        }
        $this->options = $options;
        return $this;
    }
}
