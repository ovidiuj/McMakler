<?php

namespace Neo\NasaBundle\Services;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Neo\NasaBundle\Exception\NasaException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class NasaApiService
 * @package Neo\NasaBundle\Services
 */
class NasaApiService
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $nasaApiUrl;

    /**
     * @var string
     */
    protected $nasaApiKey;

    /**
     * @var int
     */
    protected $daysNo = 3;

    /**
     * @var DateTime
     */
    private $startDate;

    /**
     * @var DateTime
     */
    private $endDate;

    /**
     * NasaApiService constructor.
     * @param ClientInterface $httpClient
     * @param $nasaApiUrl
     * @param $nasaApiKey
     */
    public function __construct(ClientInterface $httpClient, $nasaApiUrl, $nasaApiKey)
    {
        $this->httpClient = $httpClient;
        $this->nasaApiUrl = $nasaApiUrl;
        $this->nasaApiKey = $nasaApiKey;
        $this->getDateInterval();
    }

    /**
     * @param $daysNo
     */
    public function setDaysNo($daysNo)
    {
        $this->daysNo = $daysNo;
    }

    /**
     * 
     */
    private function getDateInterval()
    {
        $date = new \DateTime('now');
        $this->endDate = $date->format('Y-m-d');

        $date = new \DateTime();
        $date->sub(new \DateInterval('P' . $this->daysNo . 'D'));
        $this->startDate = $date->format('Y-m-d');
    }

    /**
     * @return NasaException|\Psr\Http\Message\StreamInterface
     */
    public function getNasaData() {

        try {
            $res = $this->httpClient->request('GET', $this->nasaApiUrl . '?api_key=' . $this->nasaApiKey,
                ['start_date' => $this->startDate, 'end_date' => $this->endDate]
            );
            return $res->getBody();
        } catch (ClientException $e) {
            return new NasaException($e->getMessage());
        } catch (Exception $e) {
            return new NasaException($e->getMessage());
        }
    }

    /**
     * @return DateTime
     */
    public function getStartDate() 
    {
        return $this->startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}