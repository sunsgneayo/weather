<?php

declare(strict_types=1);

namespace sunsgne\provider;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use sunsgne\Exception\HttpException;
use sunsgne\Exception\InvalidArgumentException;

/**
 * @purpose
 * @date 2022/5/16
 * @author zhulianyou
 */
class WeatherProvider
{

    /**
     * @var string
     */
    protected string $key;

    /**
     * @var string
     */
    protected string $city;

    /**
     * @var array
     */
    protected array $guzzleOptions = [];


    /**
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key  = $key;
    }

    /**
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * @param array $options
     */
    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * @desc: 实况天气数据信息
     * @param string $city
     * @param string $format
     * @return mixed|string
     * @throws GuzzleException
     * @author sunsgne
     */
    public function liveWeather(string $ip, string $format = 'json')
    {
        $this->city = $this->getClientCityByIp($ip)["city"];
        return $this->getWeather('base', $format);
    }

    /**
     * @desc: 预报天气信息数据
     * @param string $city
     * @param string $format
     * @return mixed|string
     * @throws GuzzleException
     * @author sunsgne
     */
    public function forecastsWeather(string $ip, string $format = 'json')
    {
        $this->city = $this->getClientCityByIp($ip)["city"];
        return $this->getWeather('all', $format);
    }

    /**
     * @param string $type
     * @param string $format
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getWeather(string $type = 'base', string $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';
        if (!\in_array(\strtolower($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: ' . $format);
        }

        if (!\in_array(\strtolower($type), ['base', 'all'])) {
            throw new InvalidArgumentException('Invalid type value(base/all): ' . $type);
        }

        $format = \strtolower($format);
        $type   = \strtolower($type);

        $query = array_filter([
            'key'        => $this->key,
            'city'       => $this->city,
            'output'     => $format,
            'extensions' => $type,
        ]);

        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();
            return 'json' === $format ? \json_decode($response, true) : $response;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $ip
     * @param string $type
     * @param string $format
     * @return mixed|string
     * @throws GuzzleException
     * @datetime 2022/5/16 17:58
     * @author zhulianyou
     */
    public function getClientCityByIp(string $ip, string $type = 'base', string $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/ip';
        if (!\in_array(\strtolower($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: ' . $format);
        }

        if (!\in_array(\strtolower($type), ['base', 'all'])) {
            throw new InvalidArgumentException('Invalid type value(base/all): ' . $type);
        }
        $format = \strtolower($format);

        $query = array_filter([
            'key' => $this->key,
            'ip'  => $ip,
        ]);
        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();
            return 'json' === $format ? \json_decode($response, true) : $response;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}