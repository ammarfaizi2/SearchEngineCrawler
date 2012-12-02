ZF2 SearchEngineCrawler module
===================

Version 0.0.1 Created by [Vincent Blanchon](http://developpeur-zend-framework.fr/)

Introduction
------------

SearchEngineCrawler is a SEO/SEA crawler.
Actually, just a draft.

Requirement
------------
* PHP 5.3.3
* ZF2.0.0
* libxml2 >= 2.7.8, see your version with

```php
php -r "phpinfo();" | grep "libxml2"
```

Usage
------------

A simple search on Google Web :

```php
$googleWeb = $this->getServiceLocator('crawler_google_web');
$set = $googleWeb->crawl('rooney', array(
    'links' => array('natural', 'image', 'video'),
    'localisation' => array('lang' => 'fr'),
));
$linkSet = $set->getPage(1)->getLinks();

echo sprintf('There are %s natural links !', count($linkSet->getNaturalResults()));
echo sprintf('There are %s image links !', count($linkSet->getImageResults()));
echo sprintf('There are %s video links !', count($linkSet->getVideoResults()));

foreach($linkSet as $position => $result) {
    echo 'Position :' . ($position+1);
    echo 'Link     :' . $result->getLink();
    echo 'Ad       :' . $result->getAd();
}
```
Features
------------

You can crawl :
* Google Web (Natural, image, video, product, premium, bottom premium, map & news link)

Page informations available :
* Google Web (Results, suggest & word spelling metadata)

Link informations :
* Extension : sitelinks
* Rich snippets : products & price


Todo
------------

ZF2 module :
* view helper to render set of result
* action helper to crawl/search

Crawl on :
* Google Images
* Google Video
* Bing Web

Other stuff:
* Crawler matcher
* Crawler with proxy
* Manage the pagination
* Mobile crawler
* Get the rich snippets & extension (rating, phone, author name)
* Link builder
* Improve workflow
* Improve unit tests with 50+ use case