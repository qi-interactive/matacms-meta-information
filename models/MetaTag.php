<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metatag\models;

use Yii;
use matacms\db\ActiveQuery;

/**
 * This is the model class for table "{{%mata_category}}".
 *
 * @property integer $Id
 * @property string $Name
 * @property string $URI
 *
 * @property MataCategoryitem[] $mataCategoryitems
 */
class MetaTag extends \matacms\db\ActiveRecord {

    public static function tableName()
    {
        return '{{%matacms_metatag}}';
    }

    public function rules()
    {
        return [
        [['Keywords', 'Description', 'DocumentId'], 'required'],
        [['Keywords', 'Description'], 'string', 'max' => 160],
        ];
    }

    public function attributeLabels()
    {
        return [
        'Id' => 'ID',
        'Keywords' => 'Keywords',
        'Description' => 'Description',
        'DocumentId' => 'Document ID',
        ];
    }

}
