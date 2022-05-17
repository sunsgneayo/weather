# 高德地图 weather 

:rainbow: 基于IP获取[高德开放平台](https://lbs.amap.com/dev/id/newuser)的天气信息插件

## 安装

```sh
composer require sunsgne/weather
```

## 使用

### 配置

[高德开放平台](https://lbs.amap.com/dev/id/newuser) 注册账号，然后创建应用，获取应用的 API Key。

### 地理位置
```php
$clientIp = $request->getRealIp();
sunsgne\Weather::getClientCityByIp($clientIp);
```
#### 响应
```php
array(7) {     
  ["status"]=> 
  string(1) "1"
  ["info"]=>   
  string(2) "OK"
  ["infocode"]=>
  string(5) "10000"
  ["province"]=>
  string(9) "重庆市"
  ["city"]=>
  string(9) "重庆市"
  ["adcode"]=>
  string(6) "500000"
  ["rectangle"]=>
  string(46) "106.2832832,29.36962828;106.8138242,29.7401968"
}

```

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