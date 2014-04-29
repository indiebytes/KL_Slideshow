# KL_Slideshow

## Install

The easiest way to install the module is by using [modman](https://github.com/karlssonlord/modman):

1. `modman clone git@github.com:indiebytes/KL_Slideshow.git`
2. `modman deploy KL_Slideshow`
3. Clear the cache
4. You're good to go

## Usage

### Slideshows

Slideshows are simply used as containers for slides. A slideshow has relations to one or more stores.


#### Layout XML

```xml
<block name="charles.mingus" type="slideshow/slideshow" template="slideshow/default.phtml">
  <action method="setSlideshow">
    <slideshow>1</slideshow>
  </action>
</block>
```

#### CMS

```
{{block type="slideshow/slideshow" template="slideshow/default.phtml" slideshow="1"}}
```

### Slides

Slides are the actual content of the slideshows. Each slideshow belongs to one or multiple slideshows and one or multiple stores.

## Authors

Andreas Karlsson <andreas@karlssonlord.com>
