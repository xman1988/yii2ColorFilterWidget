<?php

namespace xman1988\yii2ColorFilterWidget;

use yii\base\Widget;

/**
 * colorWidgetAsset контроллер виджета
 */
class ColorWidget extends Widget
{
    /**
     * @var boolean $flag Флаг, указывающий включить/выключить свойство $forceCopy класса yii\web\AssetManager
     *
     */
    public static $flag;
    /**
     * @var integer $width Ширина рамки окна изображения
     */
    public $width = 600;
    /**
     * @var integer $height Высота рамки окна изображения
     */
    public $height = 600;
    /**
     * @var string $nameDefaultPicture Имя изображения по умолчанию
     *
     */
    public $nameDefaultPicture = 'default.jpg';

    /**
     * @var boolean $filterGrey Параметр включения/выключения наложения на изображение серого цвета
     *
     */
    public $filterGrey = true;

    /**
     * @var boolean $filterRed Параметр включения/выключения фильтра красного цвета
     *
     */
    public $filterRed = true;

    /**
     * @var boolean $filterGreen Параметр включения/выключения фильтра зеленого цвета
     *
     */
    public $filterGreen = true;

    /**
     * @var boolean $filterBlue Параметр включения/выключения фильтра голубого цвета
     *
     */
    public $filterBlue = true;

    /**
     * @var array $settings Массив параметров виджета для передачи во View и JS скрипт
     *
     */
    public $settings;


    /**
     * @inheritDoc
     *
     */
    public function init()
    {
        parent::init();

        // Если изображение 'default.jpg' , то $forceCopy класса yii\web\AssetManager равно true
        // Если изображение не 'default.jpg' , то $forceCopy класса yii\web\AssetManager равно false
        self::$flag = $this->nameDefaultPicture === 'default.jpg' ? false : true;

        //Формируем путь до изображения по умолчанию
        $pathToWebAssets = $this->view->assetManager->getBundle(ColorWidgetAsset::class)->baseUrl;
        $defaultPicture = $pathToWebAssets . '/image/' . $this->nameDefaultPicture;

        //Формируем массив параметров для View и JS скриптов
        $this->settings = [
            'width' => $this->width,
            'height' => $this->height,
            'location' => $defaultPicture,
            'filterGrey' => $this->filterGrey,
            'filterRed' => $this->filterRed,
            'filterGreen' => $this->filterGreen,
            'filterBlue' => $this->filterBlue
        ];
    }

    /**
     * @inheritDoc
     *
     */
    public function run()
    {
        return $this->render('index', ['settings' => $this->settings]);
    }
}