<?php

/**
 * more information at http://www.seomoz.org/blog/a-visual-guide-to-rich-snippets
 */

namespace SearchEngineCrawler\ResultSet\Link;

use Zend\Stdlib\AbstractOptions;

class RichSnippet extends AbstractOptions
{
    protected $rating;

    protected $products;

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setProducts(array $products)
    {
        $this->products = $products;
        return $this;
    }
}
