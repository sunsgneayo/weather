# 高德地图 weather 

:rainbow: 基于IP获取[高德开放平台](https://lbs.amap.com/dev/id/newuser)的天气信息插件

## 安装

```sh
composer require sunsgne/weather
```

## 使用

### 配置

[高德开放平台](https://lbs.amap.com/dev/id/newuser) 注册账号，然后创建应用，获取应用的 API Key。

### 实时天气
```php
$clientIp = $request->getRealIp();
sunsgne\Weather::liveWeather($clientIp);
```

### 预报天气
```php
$clientIp = $request->getRealIp();
sunsgne\Weather::forecastsWeather($clientIp);
```