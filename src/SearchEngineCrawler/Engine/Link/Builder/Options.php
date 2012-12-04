<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

namespace SearchEngineCrawler\Engine\Link\Builder;

use Zend\Validator\Hostname;
use Zend\Stdlib\AbstractOptions;
use Zend\Stdlib\Exception\InvalidArgumentException;

class Options extends AbstractOptions
{
    protected $keyword;

    protected $host;

    protected $lang;

    protected $page;

    protected $numPerPage;

    public function getKeyword()
    {
        if(empty($this->keyword)) {
            throw new InvalidArgumentException('Keyword must be defined');
        }
        return $this->keyword;
    }

    public function setKeyword($keyword)
    {
        $keyword = trim($keyword);
        if(empty($keyword)) {
            throw new InvalidArgumentException(
                sprintf('Keyword "%s" is not a valid keyword', $keyword)
            );
        }
        $this->keyword = $keyword;
        return $this;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host)
    {
        $hostname = new Hostname();
        if(null === $host || !$hostname->isValid($host)) {
            throw new InvalidArgumentException(
                sprintf('Host "%s" is not a valid host', $host)
            );
        }
        $this->host = $host;
        return $this;
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $page = (integer)$page;
        if($page < 1) {
            throw new InvalidArgumentException(
                sprintf('Page "%s" must be a positive integer', $page)
            );
        }
        $this->page = $page;
        return $this;
    }

    public function getNumPerPage()
    {
        return $this->numPerPage;
    }

    public function setNumPerPage($numPerPage)
    {
        $numPerPage = (integer)$numPerPage;
        if(!$numPerPage) {
            throw new InvalidArgumentException('Num per page must be an integer');
        }
        $this->numPerPage = $numPerPage;
        return $this;
    }
}
