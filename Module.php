<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metainformation;

use mata\base\Module as BaseModule;

class Module extends BaseModule {

    public $runBootstrap = true;

	public function getNavigation() {
		return null;
	}

	public function canShowInNavigation() {
		return false;
	}
}
