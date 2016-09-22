<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metainformation\behaviors;

use Yii;
use matacms\metainformation\models\MetaInformation;
use matacms\helpers\Html;
use yii\helpers\ArrayHelper;

class MetaInformationActiveFormBehavior extends  \yii\base\Behavior {

	public function metaInformation($options = []) {

		$form = $this->owner->form;
		$metaInformationModel = $this->getMetaInformationModel();
		echo $form->field($metaInformationModel, 'Keywords')->textarea();
		echo $form->field($metaInformationModel, 'Description')->textarea();

	}

    private function getMetaInformationModel()
    {
        $metaInformationModel = MetaInformation::find()->where(['matacms_metainformation.DocumentId' => $this->getDocumentId($this->owner->model)])->one() ?: new MetaInformation;
		$metaInformationModel->load(Yii::$app->request->post());
		return $metaInformationModel;
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
