<?php

namespace xman1988\yii2ColorFilterWidget;

use yii\web\AssetBundle;

/**
 * СolorWidgetAsset класс формирования комплекта ресурсов
 */
class ColorWidgetAsset extends AssetBundle
{

    /**
     * @var string $sourcePath задаёт корневую директорию содержащую файлы ресурса в этом комплекте.
     */
    public $sourcePath;

    /**
     * @var string $baseUrl задаёт URL соответствующий директории basePath.
     */
    public $baseUrl;

    /**
     * @var array $css массив, перечисляющий CSS файлы, содержащиеся в данном комплекте.
     */
    public $css = [
        'style.css'
    ];

    /**
     * @var array $js массив, перечисляющий JavaScript файлы, содержащиеся в данном комплекте.
     */
    public $js = [
        'additional.js',
        'script.js',
    ];


    /**
     * @inheritDoc
     *
     */
    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . '\assets';
        $this->publishOptions = [
            'forceCopy' => ColorWidget::$flag
        ];
    }
}