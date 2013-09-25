<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 * This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).
 */

/**
 * more information at http://www.seomoz.org/blog/a-visual-guide-to-rich-snippets
 */

namespace SearchEngineCrawler\ResultSet\Link;

use Zend\Stdlib\AbstractOptions;

class RichSnippet extends AbstractOptions
{
    protected $rating;

    protected $products;

    protected $address;

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

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress(array $address)
	{
		$this->address = $address;
		return $this;
	}
}
