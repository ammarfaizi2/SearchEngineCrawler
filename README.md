Google Search Engine Crawler
===================

Version 0.4.X Created by [Vincent Blanchon](http://developpeur-zend-framework.fr/)

Introduction
------------

SearchEngineCrawler is a SEO/SEA/SMO crawler. The crawler use native PHP and several packages from Zend Framework 2.

**This project need contributors to keep up to date the project & improve the tests to keep project more stable.**

Licence
------------
This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/).

Requirement
------------
* PHP 5.3.3
* libxml2 >= 2.7.8, see your version with

```sh
php -r "phpinfo();" | grep "libxml2"
```

Installation
------------

* Install composer :
```sh
curl -sS https://getcomposer.org/installer | php
```

* Use composer to install the crawler :
```sh
php composer.phar require blanchonvincent/search-engine-crawler:dev-master
```

Usage in native PHP
------------

A simple search on Google Web :

```php
require_once __DIR__ . '/vendor/autoload.php';

$googleWeb = new \SearchEngineCrawler\Engine\Google\Web();
$match = $googleWeb->match('zend framework', 'http://framework.zend.com');

echo sprintf('Link has found in position "%s"', $match->getPosition());
echo sprintf('Link has found in page "%s"', $match->getPage());
```

You can specify type of links, lang, match options, etc :

```php
require_once __DIR__ . '/vendor/autoload.php';

use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;

$googleWeb = new \SearchEngineCrawler\Engine\Google\Web();
$match = $googleWeb->match('zend framework', 'http://framework.zend.com', array(
    'links' => array('natural', 'image', 'video'),
    'builder' => array(
        'lang' => GoogleLinkBuilder::LANG_FR, // en by default
        'host' => GoogleLinkBuilder::HOST_FR, // com by default
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
require_once __DIR__ . '/vendor/autoload.php';

use SearchEngineCrawler\Engine\Link\Builder\Google\AbstractGoogle as GoogleLinkBuilder;

$googleWeb = new \SearchEngineCrawler\Engine\Google\Web();
$set = $googleWeb->crawl('rooney', array(
    'links' => array('natural', 'image', 'video'),
    'builder' => array(
        'lang' => GoogleLinkBuilder::LANG_FR, // en by default
        'host' => GoogleLinkBuilder::HOST_FR, // com by default
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

Tests
------------

* Use ./run.sh to run unit tests
* Use ./debug.sh to run unit tests with stop on failure
* Use ./clean.sh to clean pages results (todo)

Todo
------------

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