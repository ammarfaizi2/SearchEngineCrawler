<?php

/*
 * This file is part of the SearchEngineCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SearchEngineCrawler\Crawler;

use Zend\Http\Client as HttpClient;
use Zend\Http\Client\Adapter\Curl;

class Simple extends AbstractCrawler
{
    /**
     * Defgaut user agent is Firefox 14
     * @var string
     */
    protected $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:14.0) Gecko/20100101 Firefox/14.0';

    protected $httpClient;

    public function crawlUri($uri)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($ch);
    }

    /**
     * Get the http client
     * @return HttpClient
     */
    public function getHttpClient()
    {
        if(null === $this->httpClient) {
            $client = new HttpClient();
            /*$client->setOptions(array(
                'user_agent' => $this->userAgent
            ));*/
            $client->setAdapter(new Curl());
            $client->getAdapter()->setOptions(array('curloptions' => array(
                CURLOPT_USERAGENT => $this->userAgent,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_FOLLOWLOCATION => 1,
            )));
            $this->setHttpClient($client);
        }
        return $this->httpClient;
    }

    /**
     * Set the http client
     * @param HttpClient $httpClient
     * @return Simple
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }
}
