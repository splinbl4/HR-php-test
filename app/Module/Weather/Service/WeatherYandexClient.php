<?php

declare(strict_types=1);

namespace App\Module\Weather\Service;

use App\Module\Weather\Entity\City;
use Exception;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

/**
 * Class WeatherClient
 * @package App\Module\Weather\Entity
 */
class WeatherYandexClient implements WeatherClientInterface
{
    private Client $httpClient;

    private LoggerInterface $logger;

    /**
     * WeatherYandexClient constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->httpClient = new Client([
            'base_uri' => config('services.weather.yandex.base_uri'),
            'headers' => [
                'X-Yandex-API-Key' => config('services.weather.yandex.key'),
            ],
        ]);

        $this->logger = $logger;
    }

    /**
     * @param City $city
     * @return int|null
     */
    public function getCurrentTemperature(City $city): ?int
    {
        try {
            $coordinates = $city->getCoordinates();
            $uri = '?' . http_build_query(['lat' => $coordinates->getLat(), 'lon' => $coordinates->getLon()]);
            $response = json_decode($this->httpClient->get($uri)->getBody()->getContents());

            return (int)$response->fact->temp;
        } catch (Exception $exception) {
            $this->logger->error('yandex api get not success response', ['response' => $exception->getMessage()]);

            return null;
        }
    }
}
