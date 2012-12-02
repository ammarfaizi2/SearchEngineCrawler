<?php

namespace SearchEngineCrawler\ResultSet\Link;

use ArrayObject;

class ResultSet extends ArrayObject
{
    public function merge(ResultSet $set)
    {
        foreach($set as $result) {
            if($this->offsetExists($result->getPosition())) {
                throw new \Exception(
                    sprintf('Invalid position "%s", node exists', $result->getPosition())
                );
            }
            $this->offsetSet($result->getPosition(), $result);
        }
        return $this;
    }

    public function sort()
    {
        $this->ksort();
        $datas = array_values($this->getArrayCopy());
        $this->exchangeArray($datas);
        return $this;
    }

    /**
     * Check if the resultset have image result
     * @return boolean
     */
    public function hasNaturalResult()
    {
        foreach($this as $result) {
            if($result instanceof Result\Natural) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all the natural result
     * @return ResultSet
     */
    public function getNaturalResults()
    {
        $set = new ResultSet();
        foreach($this as $result) {
            if($result instanceof Result\Natural) {
                $set->append(clone $result);
            }
        }
        return $set;
    }

    /**
     * Check if the resultset have image result
     * @return boolean
     */
    public function hasImageResult()
    {
        foreach($this as $result) {
            if($result instanceof Result\Image) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all the image result
     * @return ResultSet
     */
    public function getImageResults()
    {
        $set = new ResultSet();
        foreach($this as $result) {
            if($result instanceof Result\Image) {
                $set->append(clone $result);
            }
        }
        return $set;
    }

    /**
     * Check if the resultset have video result
     * @return boolean
     */
    public function hasVideoResult()
    {
        foreach($this as $result) {
            if($result instanceof Result\Video) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all the video result
     * @return ResultSet
     */
    public function getVideoResults()
    {
        $set = new ResultSet();
        foreach($this as $result) {
            if($result instanceof Result\Video) {
                $set->append(clone $result);
            }
        }
        return $set;
    }

    /**
     * Check if the resultset have product result
     * @return boolean
     */
    public function hasProductResult()
    {
        foreach($this as $result) {
            if($result instanceof Result\Product) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all the product result
     * @return ResultSet
     */
    public function getProductResults()
    {
        $set = new ResultSet();
        foreach($this as $result) {
            if($result instanceof Result\Product) {
                $set->append(clone $result);
            }
        }
        return $set;
    }

    /**
     * Check if the resultset have premium result
     * @return boolean
     */
    public function hasPremiumResult()
    {
        foreach($this as $result) {
            if($result instanceof Result\Premium) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all the premium result
     * @return ResultSet
     */
    public function getPremiumResults()
    {
        $set = new ResultSet();
        foreach($this as $result) {
            if($result instanceof Result\Premium) {
                $set->append(clone $result);
            }
        }
        return $set;
    }

    /**
     * Check if the resultset have premium bottom result
     * @return boolean
     */
    public function hasPremiumBottomResult()
    {
        foreach($this as $result) {
            if($result instanceof Result\PremiumBottom) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all the premium bottom result
     * @return ResultSet
     */
    public function getPremiumBottomResults()
    {
        $set = new ResultSet();
        foreach($this as $result) {
            if($result instanceof Result\PremiumBottom) {
                $set->append(clone $result);
            }
        }
        return $set;
    }

    /**
     * Check if the resultset have map result
     * @return boolean
     */
    public function hasMapResult()
    {
        foreach($this as $result) {
            if($result instanceof Result\Map) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all the map result
     * @return ResultSet
     */
    public function getMapResults()
    {
        $set = new ResultSet();
        foreach($this as $result) {
            if($result instanceof Result\Map) {
                $set->append(clone $result);
            }
        }
        return $set;
    }

    /**
     * Check if the resultset have news result
     * @return boolean
     */
    public function hasNewsResult()
    {
        foreach($this as $result) {
            if($result instanceof Result\News) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get all the news result
     * @return ResultSet
     */
    public function getNewsResults()
    {
        $set = new ResultSet();
        foreach($this as $result) {
            if($result instanceof Result\News) {
                $set->append(clone $result);
            }
        }
        return $set;
    }
}
