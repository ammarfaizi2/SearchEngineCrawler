<?php

namespace SearchEngineCrawler\Crawler;

use Zend\Http\Client as HttpClient;
use Zend\Http\Client\Adapter\Curl;

class HttpClient extends AbstractCrawler
{
    /**
     * Defgaut user agent is Firefox 14
     * @var string
     */
    protected $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:14.0) Gecko/20100101 Firefox/14.0';

    protected $httpClient;

    public function crawl($engine, $keyword, array $options = array())
    {
        if($this->getSource()) {
            return $this;
        }
        $linkBuilder = $this->getLinkBuilderManager()->get($engine);
        $link = $linkBuilder->build($keyword, 1, $options);

        $client = $this->getHttpClient();
        $client->setUri($link);
        $content = $client->send();

        $this->setSource($content);
        return $this;
    }

    /**
     * Get the http client
     * @return HttpClient
     */
    public function getHttpClient()
    {
        if(null === $this->httpClient) {
            $client = new HttpClient();
            $client->setOptions(array(
                'user_agent' => $this->userAgent
            ));
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
