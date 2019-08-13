<?php

use yii\helpers\Json;
use xman1988\yii2ColorFilterWidget\ColorWidgetAsset;
use yii\web\View;
/**
 * регистрируем комплект ресурсов
 */
ColorWidgetAsset::register($this);

/**
 * регистрируем JS скрипт и передаем массив параметров $settings
 */
$this->registerJs("var settings = " . Json::encode($settings) . ";", View::POS_HEAD);

/* @var $this \yii\web\View */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Photo editor</title>
</head>
<body>
<table>
    <tr>
        <td>
            <canvas id='canvas'></canvas>
        </td>
        <td class="boxes">
            <input type="file" id='loadImage'>
            <br>

            <?php
            if ($settings['filterGrey']) {
                echo "    
                        <input type='checkbox' id='filterGray' />
                        <label for='filterGray' class=\"greyLabel\">Серый фильтр</label>
                        <br>
                        ";
            }
            if ($settings['filterRed']) {
                echo "    
                            <input type=\"checkbox\" id='filterRed' />
                            <label for=\"filterRed\" class=\"redLabel\">Фильтр красного</label>
                            <br>
                            ";
            }
            if ($settings['filterGreen']) {
                echo "    
                                <input type=\"checkbox\" id='filterGreen' />
                                <label for=\"filterGreen\" class=\"greenLabel\">Фильтр зеленого</label>
				                <br>
                            ";
            }
            if ($settings['filterBlue']) {
                echo "    
                                <input type=\"checkbox\" id='filterBlue' />
                                <label for=\"filterBlue\" class=\"blueLabel\">Фильтр синего</label>
                                <br>
                                ";
            }
            if (!$settings['filterGrey'] and !$settings['filterRed'] and !$settings['filterGreen'] and !$settings['filterBlue']) {
                echo "<p class=\"text warning\">Все фильтры выключены!</p>";
            }
            ?>

            <div class="ccd"><a href="#" id='download'>Скачать</a></div>


            <p class="text">Ширина рамки: <?php echo $settings['width']; ?> px</p>
            <p class="text">Высота рамки: <?php echo $settings['height']; ?> px</p>
        </td>
    </tr>
</table>
</body>
</html>