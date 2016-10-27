<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\metainformation\clients;

use matacms\metainformation\models\MetaInformation;

class MetaInformationClient extends \matacms\clients\SimpleClient {

    protected function getModel()
    {
        return new MetaInformation();
    }

    public function findByOwnerDocumentId($ownerDocumentId)
    {

		$model = $this->getModel();
		$this->closureParams = [$model, $ownerDocumentId];

		$model = $model::getDb()->cache(function ($db) {
			$closureParams = $this->getClosureParams();
			return $closureParams[0]->find()->where(['matacms_metainformation.DocumentId' => $closureParams[1]])->one();
		}, null, new \matacms\cache\caching\MataLastUpdatedTimestampDependency());

		return $model;
	}

}
