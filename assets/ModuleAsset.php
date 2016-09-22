<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metainformation\assets;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle
{
	public $sourcePath = '@vendor/matacms/matacms-meta-information/web';

	public $js = [
	];

	public $depends = [
		'yii\web\YiiAsset'
	];
}
