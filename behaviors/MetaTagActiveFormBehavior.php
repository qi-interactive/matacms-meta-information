<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metatag\behaviors;

use Yii;
use matacms\metatag\models\MetaTag;
use matacms\helpers\Html;
use yii\helpers\ArrayHelper;

class MetaTagActiveFormBehavior extends  \yii\base\Behavior {

	public function metaTags($options = []) {

		return;

		if(isset($this->owner->options['class'])) {
		    $this->owner->options['class'] .= ' full-width';
		} else {
			$this->owner->options['class'] = ' full-width';
		}

		$options = array_merge($this->owner->inputOptions, $options);

        $this->owner->parts['{label}'] = '';

		$this->owner->adjustLabelFor($options);

		$this->owner->parts['{input}'] = $this->getInputWidget($this->owner);

		return $this->owner;
	}

    private function getInputWidget($owner)
    {
        $metaTagModel = $this->findMetaTagModel();
        $metaTagModel->load(Yii::$app->request->post());

        return \matacms\metatag\widgets\MetaTagWidget::widget([
            'model' => $metaTagModel,
            'documentId' => $this->getDocumentId($owner->model),
            'form' => $this->owner->form
        ]);
    }

    private function findMetaTagModel()
    {
         return MetaTag::find()->where(['DocumentId' => $this->getDocumentId($owner->model)])->one();
    }

}
