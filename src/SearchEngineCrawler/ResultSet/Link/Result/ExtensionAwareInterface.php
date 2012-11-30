<?php

namespace SearchEngineCrawler\ResultSet\Link\Result;

use SearchEngineCrawler\ResultSet\Link\Extension;

interface ExtensionAwareInterface
{
    public function getExtension();
    public function setExtension(Extension $extension);
}
