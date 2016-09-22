<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metatag\validators;

use yii\web\AssetBundle;

class MandatoryMetaTagValidationAsset extends AssetBundle
{
    public $sourcePath = '@vendor/matacms/matacms-meta-tag/assets';
    public $js = [
        'js/matacms.metatag.validation.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
