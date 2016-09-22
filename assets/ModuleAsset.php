<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metatag\assets;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle
{
	public $sourcePath = '@vendor/matacms/matacms-meta-tag/web';

	public $js = [
	];

	public $depends = [
		'yii\web\YiiAsset'
	];
}
