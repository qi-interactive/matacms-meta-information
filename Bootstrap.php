<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metatag;

use Yii;
use matacms\metatag\behaviors\MetaTagActiveFormBehavior;
use yii\base\Event;
use yii\base\Model;
use matacms\widgets\ActiveField;
use mata\base\MessageEvent;
use matacms\metatag\models\MetaTag;

//TODO Dependency on matacms
use matacms\controllers\module\Controller;

class Bootstrap extends \mata\base\Bootstrap {

	public function bootstrap($app)
	{
		Event::on(ActiveField::className(), ActiveField::EVENT_INIT_DONE, function(MessageEvent $event) {
			$event->getMessage()->attachBehavior('metaTags', new MetaTagActiveFormBehavior());
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

		Event::on(Model::class, Model::EVENT_BEFORE_VALIDATE, function(\yii\base\ModelEvent $event) {
			if($event->sender instanceof \mata\db\ActiveRecord) {
				$activeValidators = $event->sender->getActiveValidators();

				foreach($activeValidators as $validator) {
					if(get_class($validator) != 'matacms\metatag\validators\MandatoryMetaTagValidator')
						continue;

					$event->sender->addAdditionalAttribute('MetaTag');
				}
			}

		});
	}

	private function processSave($model)
	{
		if (empty($metaTags = Yii::$app->request->post('MetaTag')))
			return;

		$documentId = $model->getDocumentId()->getId();

		$metaTagModel = MetaTag::find()->where(["matacms_metatag.DocumentId" => $documentId])->one() ?: new MetaTag;
		$metaTagModel->Keywords = $metaTags['Keywords'];
		$metaTagModel->Description = $metaTags['Description'];
		$metaTagModel->DocumentId = $documentId;

		if (!$metaTagModel->save())
			throw new \yii\web\ServerErrorHttpException($metaTagModel->getTopError());
	}

    private function processDelete($model)
	{
		MetaTag::deleteAll(["DocumentId" => $model->getDocumentId()->getId()]);
	}
}
