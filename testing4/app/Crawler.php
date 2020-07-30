<?php

namespace testing4\app;
use GuzzleHttp\Promise;

class Crawler implements CrawlerInterface
{
    private $client;

    public function getPageHtml(string $url, string $method): string
    {
        $response = $this->getClient()->request($method, $url);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('No response');
        }

        return $response->getBody();
    }

    public function getMultiplePageHtml(array $urls, string $method): array
    {
        $requests = array_map(function ($url) use ($method) {
            return $this->getClient()->requestAsync($method, $url);
        }, $urls);

        $responses = Promise\settle($requests)->wait();

        return array_map(function($response) {
            return (string) $response['value']->getBody();
        }, $responses);
    }


    protected function getClient()
    {
        if (!$this->client) {
            $this->client = new \GuzzleHttp\Client();
        }

        return $this->client;
    }
}
