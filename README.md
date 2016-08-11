# GoogleChartWrapper

[![Build Status](https://travis-ci.org/ipMediaDevs/GoogleChartWrapper.svg?branch=master)](https://travis-ci.org/ipMediaDevs/GoogleChartWrapper)

## Introduction

GoogleChartWrapper is a quick clean api over the [Google Image Chart Service](https://developers.google.com/chart/image/).

> **Warning:** This API is deprecated.

Although the API is deprecated and it can be turned off without notice, 
its still a great choice when you have to quickly generate chats for email reports.
Feel free to  imporove it as you like.


## Instalation

```bash
composer require ipmedia/google-chart-wrapper
```

## Usage

```php

use \IpMedia\GoogleChartWrapper;

// instantiate wrapper
$wrapper = new GoogleChartWrapper;

// set the data to be rendered
$wrapper->setData([ 5, 2, 3 ]);

// render the link to the google api generator
$wrapper->getSrc();  // http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3

// change the type of the chart
$wrapper->setType(GoogleChartWrapper::PIE)->getSrc();  // http://chart.apis.google.com/chart?cht=p&chs=450x200&chd=t:5,2,3

// set the size of the chart
$wrapper->setSize(200, 200)->$this->getSrc();  // http://chart.apis.google.com/chart?cht=p3&chs=200x200&chd=t:5,2,3

// set the base color
$wrapper->setBaseColor('00ffff')->getSrc(); // http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chco=00ffff
// rgb supported
$wrapper->setBaseColor([ 0, 255, 255 ])->getSrc(); // http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chco=00ffff

// set the base color
$wrapper->setGradientColor([ 0, 0, 0 ], [ 255, 255, 255 ])->getSrc(); // http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chco=000000,ffffff

// or set a color for each segment
$this->setColors([ [ 255, 0, 0 ], [ 0, 255, 0 ], [ 0, 0, 255 ] ])->getSrc(); // http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chco=ff0000|00ff00|0000ff

// add labels
$wrapper->setLabels([ 'Five', 'Two', 'Four' ])->getSrc();  // http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chl=Five|Two|Four

// and finally you can set the labels of the chart 
$wrapper->setTitle('Chart Title')->getSrc();  // http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chtt=Chart+Title

```

## License

GoogleChartWrapper is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
