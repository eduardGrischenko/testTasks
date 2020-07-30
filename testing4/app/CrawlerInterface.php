<?php

namespace testing4\app;

interface CrawlerInterface
{
    /**
     * @param string $url
     * @param string $method
     * @return string Send synchronous request to retrieve page html
     */
    public function getPageHtml(string $url, string $method): string;

    /**
     * @param array $urls
     * @param string $method
     * @return array Send asynchronous request to retrieve multiple pages html
     */
    public function getMultiplePageHtml(array $urls, string $method): array;
}
