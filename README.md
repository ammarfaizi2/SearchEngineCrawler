ZF2 SearchEngineCrawler module
===================

Version 0.0.1 Created by [Vincent Blanchon](http://developpeur-zend-framework.fr/)

Introduction
------------

SearchEngineCrawler is a SEO/SEA crawler.
Actually, just a draft.

Requirement
------------
libxml2 >= 2.7.8

Usage
------------

A simple search on Google Web :

```php
use SearchEngineCrawler\Engine\Google\Web as GoogleWeb;

$google = new GoogleWeb();
$resultsSet = $google->crawl('rooney', array(
    'links' => array('natural', 'image', 'video'),
    'localisation' => array('lang' => 'fr'),
));

foreach($resultsSet as $position => $result) {
    echo 'position :' . ($position+1);
    echo 'link     :' . $result->getLink();
    echo 'ad       :' . $result->getAd();
}
```
Features
------------

You can crawl :
* Google Web (Natural, image & video link)


Todo
------------

Crawl on :
* Google Web (Product, maps, news, shooping & premium link)
* Google Images
* Google Video
* Bing Web

Other stuff:
* Crawler matcher
* Crawler with proxy
* Crawler with pagination
* Crawler with Zend\Client
* Link builder
* Improve workflow with event manager