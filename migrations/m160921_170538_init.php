<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

use yii\db\Schema;
use yii\db\Migration;

class m160921_170538_init extends Migration {

	public function safeUp()
    {
		$this->createTable('{{%matacms_metainformation}}', [
			'Id' => Schema::TYPE_PK,
			'Keywords' => Schema::TYPE_STRING . '(255) NOT NULL',
			'Description' => Schema::TYPE_STRING . '(255) NOT NULL',
            'DocumentId'   => Schema::TYPE_STRING . '(128) NOT NULL',
			]);
	}

	public function safeDown()
    {
		$this->dropTable('{{%matacms_metainformation}}');
	}

}
