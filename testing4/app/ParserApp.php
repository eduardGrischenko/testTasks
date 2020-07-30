<?php

namespace testing4\app;

class ParserApp
{
    const ARCHIVE_PAGE_URL = 'https://terrikon.com/football/italy/championship/archive';

    /**
     * @var CrawlerInterface
     */
    private $crawler;

    public function __construct(CrawlerInterface $crawler)
    {
        $this->crawler = $crawler;
    }

    public function execute(string $requestedTeam)
    {
        $archivePageHtml = $this->crawler->getPageHtml(self::ARCHIVE_PAGE_URL, 'GET');

        $htmlDom = new \simple_html_dom();
        $seasonTableUrls = $htmlDom->load($archivePageHtml)->find('.maincol .news a');
        $seasonTableData = $result = [];

        foreach ($seasonTableUrls as $seasonTableUrl) {
            $season = substr($seasonTableUrl->plaintext, 0, 7); // TODO: Regex
            $seasonTableData[$season] = 'https://terrikon.com' . $seasonTableUrl->href;
        }

        if (empty($seasonTableData)) {
            throw new Exception('No data');
        }

        $seasonsComplete = $this->crawler->getMultiplePageHtml(array_values($seasonTableData), 'GET');
        $seasonsComplete = array_combine(array_keys($seasonTableData), array_values($seasonsComplete));

        foreach ($seasonsComplete as $season => $seasonHtml) {
            $seasonHtmlDom = new \simple_html_dom($seasonHtml);

            foreach ($seasonHtmlDom->find('.content-site .maincol .tab tr') as $teamRow) {
                if ($teamRow->find('th')) {
                    continue;
                }
                $data = $teamRow->find('td');
                $teamPosition = (int)$data[0]->plaintext;
                $team = $data[1]->plaintext;

                $result[$season][$team] = $teamPosition;

                if ($team === $requestedTeam ) {
                    echo "Сезон: $season" . ". Позиция: $teamPosition" . "</br>";
                }
            }

        }

    }
}