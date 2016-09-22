<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metatag\validators;

use Yii;
use yii\validators\Validator;
use yii\helpers\Json;
use yii\helpers\Inflector;
use matacms\metatag\validators\MandatoryMetaTagValidationAsset;


class MandatoryCategoryValidator extends Validator
{

    public function init()
    {

        parent::init();
        $this->skipOnEmpty = false;
        if ($this->message === null)
            $this->message = Yii::t('yii', '{attribute} cannot be blank.');

    }

    public function validateAttribute($model, $attribute)
    {

        $metaTag = \Yii::$app->request->post('MetaTag[' . $attribute . ']');

        if(empty($metaTag)) {
            $model->addError($attribute, \Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => Inflector::camel2words($attribute)]));
        }

    }

    public function clientValidateAttribute($model, $attribute, $view) {

        $options = [
            'attribute' => $attribute,
            'name' => 'MetaTag',
            'message' => Yii::$app->getI18n()->format($this->message, [
                'attribute' => Inflector::camel2words($attribute),
            ], Yii::$app->language),
        ];

        MandatoryMetaTagValidationAsset::register($view);
        return 'matacms.metatag.validation.mandatory($form, value, messages, ' . Json::encode($options) . ');';
    }
}
