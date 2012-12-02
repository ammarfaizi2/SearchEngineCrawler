<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\ResultSet\Link\Result;

use SearchEngineCrawler\ResultSet\Link\RichSnippet;

interface RichSnippetAwareInterface
{
    public function getRichsnippet();
    public function setRichsnippet(RichSnippet $richSnippet);
}
