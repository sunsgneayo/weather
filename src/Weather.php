<?php
declare(strict_types=1);

namespace sunsgne;

use sunsgne\provider\WeatherProvider;
use Webman\Bootstrap;
use Workerman\Worker;

/**
 * @see WeatherProvider
 * @mixin Weather
 * @method static liveWeather(string $ip = "") 实况天气数据信息
 * @method static forecastsWeather(string $ip = "") 预报天气信息数据
 */
class Weather implements Bootstrap
{

    /**
     * @var null
     */
    protected static $_provider = null;

    /**
     * @desc: start 描述
     * @param Worker $worker
     * @return void
     * @author sunsgne
     */
    public static function start($worker)
    {
        if ($worker) {
            static::$_provider = new WeatherProvider("1d7ac8e98d6254dd78501c27a02ede45");
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return static::$_provider->{$name}(...$arguments);
    }
}