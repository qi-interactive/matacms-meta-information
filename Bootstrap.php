<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metainformation;

use Yii;
use matacms\metainformation\behaviors\MetaInformationActiveFormBehavior;
use yii\base\Event;
use yii\base\Model;
use matacms\widgets\ActiveField;
use mata\base\MessageEvent;
use matacms\metainformation\models\MetaInformation;

//TODO Dependency on matacms
use matacms\controllers\module\Controller;

class Bootstrap extends \mata\base\Bootstrap {

	public function bootstrap($app)
	{
		Event::on(ActiveField::className(), ActiveField::EVENT_INIT_DONE, function(MessageEvent $event) {
			$event->getMessage()->attachBehavior('metaInformation', new MetaInformationActiveFormBehavior());
		});

		Event::on(Controller::class, Controller::EVENT_MODEL_UPDATED, function(\matacms\base\MessageEvent $event) {
			$this->processSave($event->getMessage());
		});

		Event::on(Controller::class, Controller::EVENT_MODEL_CREATED, function(\matacms\base\MessageEvent $event) {
			$this->processSave($event->getMessage());
		});

        Event::on(Controller::class, Controller::EVENT_MODEL_DELETED, function(\matacms\base\MessageEvent $event) {
			$this->processDelete($event->getMessage());
		});
	}

	private function processSave($model)
	{
		if (empty($metaInformation = Yii::$app->request->post('MetaInformation')))
			return;

		$documentId = $model->getDocumentId()->getId();

		$metaInformationModel = MetaInformation::find()->where(["matacms_metainformation.DocumentId" => $documentId])->one() ?: new MetaInformation;
		$metaInformationModel->Keywords = $metaInformation['Keywords'];
		$metaInformationModel->Description = $metaInformation['Description'];
		$metaInformationModel->DocumentId = $documentId;

		if (!$metaInformationModel->save())
			throw new \yii\web\ServerErrorHttpException($metaInformationModel->getTopError());
	}

    private function processDelete($model)
	{
		MetaInformation::deleteAll(["DocumentId" => $model->getDocumentId()->getId()]);
	}
}
