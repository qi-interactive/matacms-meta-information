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

		$form = $this->owner->form;
		$metaTagModel = $this->getMetaTagModel();
		echo $form->field($metaTagModel, 'Keywords')->textarea();
		echo $form->field($metaTagModel, 'Description')->textarea();

	}

    private function getMetaTagModel()
    {
        $metaTagModel = MetaTag::find()->where(['matacms_metatag.DocumentId' => $this->getDocumentId($this->owner->model)])->one() ?: new MetaTag;
		$metaTagModel->load(Yii::$app->request->post());
		return $metaTagModel;
    }

	private function getDocumentId($model)
    {
        $documentId = $model->getDocumentId()->getId();
		$pattern = '/([a-zA-Z\\\]*)-([a-zA-Z0-9]*)(::)?([a-zA-Z0-9]*)?/';
		preg_match($pattern, $documentId, $matches);
		if(!empty($matches) && empty($matches[2])) {
			$pk = uniqid('tmp_');
			if(!empty($matches[4]))
				$pk .= "::" . $matches[4];
			$documentId = $matches[1] . "-" . $pk;
		}

        return $documentId;
    }

}
