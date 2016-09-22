<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metainformation\models;

use Yii;
use matacms\db\ActiveQuery;

/**
 * This is the model class for table "{{%matacms_metainformation}}".
 *
 * @property integer $Id
 * @property string $Keywords
 * @property string $Description
 * @property string $DocumentId
 *
 */
class MetaInformation extends \matacms\db\ActiveRecord {

    public static function tableName()
    {
        return '{{%matacms_metainformation}}';
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
        'Keywords' => 'Meta Keywords',
        'Description' => 'Meta Description',
        'DocumentId' => 'Document ID',
        ];
    }

}
