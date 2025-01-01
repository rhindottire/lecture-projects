# showTimer

![GitHub last commit](https://img.shields.io/github/last-commit/lee-ratinan/showTimer)
![GitHub](https://img.shields.io/github/license/lee-ratinan/showTimer)
![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/lee-ratinan/showTimer?include_prereleases)
![GitHub issues](https://img.shields.io/github/issues-raw/lee-ratinan/showTimer)
![GitHub top language](https://img.shields.io/github/languages/top/lee-ratinan/showTimer)

A jQuery plugin to generate a countdown timer in 2 different formats.

## Requirements

To use this library, you need to include jQuery library.

## Simple timer

To generate a simple timer (e.g. EXPIRES IN 2d 3h 20m 9s), simply call showTimer function. See example below:

```html
<div id="wrapper">EXPIRES IN <span id="selector" data-start="2018-06-21T00:00:00" data-end="2018-06-29T00:00:00"></span></div>
```

```javascript
$(function () {
  $('#selector').showTimer({returnType: "text", wrapper_id: "wrapper"});
});
```

## Timer in Boxes

The same goes to the box format. It returns the boxes with days/hours/minutes/seconds inside each box.

```html
<div id="wrapper_2">EXPIRES IN <span id="selector2" data-start="2018-06-21T00:00:00" data-end="2018-06-29T00:00:00"></span></div>
```

```javascript
$(function () {
  $('#selector2').showTimer({returnType: "box", wrapper_id: "wrapper_2"});
});
```

## TimeZone Concerned

The default timezone is +00:00, unless specify in the javascript or as the attribute of the HTML tag.

```html
<div span="selector3" data-timezone="-05:00"></div>
```

or

```javascript
$(function () {
  $('#selector3').showTimer({timeZone: "+08:00"});
});
```

Please note that the HTML attribute overrides the one in jQuery.

## Parameters

### In $().showTimer()
1. returnType: either "text" or "box" (default: text)
2. timeZone: javascript timezone (default +00:00)
3. wrapper_id: The wrapper ID or class name of the wrapper that will be hidden when the timer hits zero. (if '.' or '#' is not present, it is prepended by '#')
4. timesup_wrapper_id: The ID or class name of the element to be shown when the timer hits zero. (if '.' or '#' is not present, it is prepended by '#')
5. noshow_wrapper_id: The ID or class name of the element to be shown when (on page load), it is before start time or after end time (and the timer is hidden).
6. local_s_days: the abbreviation of 'days' in target language (default "d") used in the text format
7. local_s_hrs: the abbreviation of 'hours' in target language (default "h") used in the text format
8. local_s_min: the abbreviation of 'minutes' in target language (default "m") used in the text format
9. local_s_sec: the abbreviation of 'seconds' in target language (default "s") used in the text format
10. local_l_days: the word 'DAYS' in target language (default "DAYS") used in the box format
11. local_l_hrs: the word 'HOURS' in target language (default "HRS") used in the box format
12. local_l_min: the word 'MINUTES' in target language (default "MIN") used in the box format
13. local_l_sec: the word 'SECONDS' in target language (default "SEC") used in the box format

### In data- attribute
1. data-timezone: javascript timezone (default +00:00)
2. data-start: timestamp of the starting point of the countdown
3. data-end: timestamp of the ending point of the countdown
4. data-return-type: either "text" or "box"
5. data-wrapper-id: The wrapper ID or class name of the wrapper that will be hidden when the timer hits zero. (if '.' or '#' is not present, it is prepended by '#')
6. data-timesup-wrapper-id: The ID or class name of the element to be shown when the timer hits zero. (if '.' or '#' is not present, it is prepended by '#')
7. data-noshow-wrapper-id: The ID or class name of the element to be shown when (on page load), it is before start time or after end time (and the timer is hidden).

## Localization

In javascript, you can pass the translated string to replace the default English. Here are some of the translations.

### Spanish

```
{
    'local_s_days': 'd',
    'local_s_hrs': 'h',
    'local_s_min': 'm',
    'local_s_sec': 's',
    'local_l_days': 'días',
    'local_l_hrs': 'horas',
    'local_l_min': 'minutos',
    'local_l_sec': 'segundos',
}
```

### Thai

```
{
    'local_s_days': 'วัน',
    'local_s_hrs': 'ช.ม.',
    'local_s_min': 'นาที',
    'local_s_sec': 'วิ',
    'local_l_days': 'วัน',
    'local_l_hrs': 'ชั่วโมง',
    'local_l_min': 'นาที',
    'local_l_sec': 'วินาที',
}
```

### Chinese

```
{
    'local_s_days': '天',
    'local_s_hrs': '时',
    'local_s_min': '分',
    'local_s_sec': '秒',
    'local_l_days': '天',
    'local_l_hrs': '时',
    'local_l_min': '分',
    'local_l_sec': '秒',
}
```