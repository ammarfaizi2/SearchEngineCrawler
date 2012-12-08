ZF2 SearchEngineCrawler module
===================

Version 0.4.2 Created by [Vincent Blanchon](http://developpeur-zend-framework.fr/)

Introduction
------------

SearchEngineCrawler is a SEO/SEA/SMO crawler.

Licence
------------
This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).

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
$match = $googleWeb->match('zend framework', 'http://framework.zend.com');

echo sprintf('Link has found in position "%s"', $match->getPosition());
echo sprintf('Link has found in page "%s"', $match->getPage());
```

You can specify type of links, lang, match options, etc :

```php
$googleWeb = $this->getServiceLocator('crawler_google_web');
$match = $googleWeb->match('zend framework', 'http://framework.zend.com', array(
    'links' => array('natural', 'image', 'video'),
    'builder' => array(
        'lang' => 'fr', // en by default
        'host' => 'fr', // com by default
    ),
    'match' => array(
        'strictMode' => true, // each uri path must match strictly, true by default
        'strictDns' => false, // do not check subdomain, true by default
    ),
));

echo sprintf('Link has found in position "%s"', $match->getPosition());
echo sprintf('Link has found in page "%s"', $match->getPage());
```

A simple crawl on Google Web :

```php
$googleWeb = $this->getServiceLocator('crawler_google_web');
$set = $googleWeb->crawl('rooney', array(
    'links' => array('natural', 'image', 'video'),
    'builder' => array(
        'lang' => 'fr', // en by default
        'host' => 'fr', // com by default
    ),
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

You can crawl & match:

* Google Web (natural, image, video, product, premium, bottom premium, map & news)
* Google Image (image)
* Google Video (video & natural)
* Google Book (book & premium)
* Google News (news, image & natural)
* Google Shopping (product, premium & bottom premium)

* Youtube (video)

Page informations available :
* Number of results
* Queries suggest
* Word spelling

Link informations :
* Extension : sitelinks
* Rich snippets : products & price


Todo
------------

ZF2 module :
* action helper to crawl/search
* view helper to render set of result

Crawl on :
* Youtube (premium & bottom premium) + metadatas
* Dailymotion
* Google Map
* Google Address

Other stuff:
* Mobile crawler
* Get & improve the rich snippets & extension (rating, phone, author name)

Code :
* Improve the result link type
* Improve workflow
* Improve unit tests with 50+ use case