Yii2 Filter Color Widget
======================
Виджет для Yii2. Визуальный редактор изображений для наложения цветовых фильтров

Установка
------------

Рекомендуемый способ установки данного виджета через  [composer](http://getcomposer.org/download/).

Либо запустите команду в консоли:

```
php composer.phar require --prefer-dist xman1988/yii2-color-filter-widget "*"
```

либо добавьте команду в секцию require вашего `composer.json` файла:

```
"xman1988/yii2-color-filter-widget": "*"
```


Быстрый старт
-----

Когда виджет будет установлен в ваш проект, добавьте следующий код
 в ваш файл:

```php

<?= \xman1988\yii2ColorFilterWidget\ColorWidget::widget(); ?>

```

Использование с параметрами
-----
Вы можете подключить виджет на страницу и задать параметры, 
указанные ниже для его настройки:

```php
<?
use xman1988\yii2ColorFilterWidget\ColorWidget;

echo ColorWidget::widget(
    [
        'width'=>600,
        'height'=>800,
        'nameDefaultPicture' => 'default.jpg',
        'filterGrey' => true,
        'filterRed' => true,
        'filterGreen' => true,
        'filterBlue' => true
    ]
);

?>
```

####  Описание параметров

**'width'** - (тип значения - integer) 
Ширина рамки окна изображения.
 По умолчанию: 600,

**'height'** - (тип значения - integer) 
Высота рамки окна изображения.
 По умолчанию: 600,

**'nameDefaultPicture'** - (тип значения - string) 
Имя изображения по умолчанию.
 По умолчанию: 'default',

**'filterGrey'** - (тип значения - boolean) 
Параметр включения/выключения наложения на изображение серого цвета. 
По умолчанию: 'true',

**'filterRed'** - (тип значения - boolean) 
Параметр включения/выключения фильтра красного цвета,
По умолчанию: 'true',

**'filterGeen'** - (тип значения - boolean) 
Параметр включения/выключения фильтра зеленого цвета,
По умолчанию: 'true',

**'filterBlue'** - (тип значения - boolean) 
Параметр включения/выключения фильтра синего цвета,
По умолчанию: 'true',

