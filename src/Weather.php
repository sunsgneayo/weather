<?php

namespace Sunsgne;

use Sunsgne\provider\WeatherProvider;
use Webman\Bootstrap;
use Workerman\Worker;
/**
 * @purpose
 * @date 2022/5/16
 * @author zhulianyou
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
            $config = [
                    'key' => '	1d7ac8e98d6254dd78501c27a02ede45'
            ];
//            $config = config('plugin.tinywan.weather.app.weather');
            static::$_provider = new WeatherProvider($config['key']);
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