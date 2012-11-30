<?php

namespace SearchEngineCrawler\ResultSet\Link\Result;

use Zend\Stdlib\AbstractOptions;

abstract class AbstractResult extends AbstractOptions implements ResultInterface
{
    protected $position;

    protected $link;

    protected $ad;

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    public function getAd()
    {
        return $this->ad;
    }

    public function setAd($ad)
    {
        $this->ad = $ad;
        return $this;
    }
}
