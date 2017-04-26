<?php

namespace matacms\metainformation\helpers;

/**
 * Description of MetaInformation
 *
 * @author mfiedorowicz
 */
class MetaInformationHelper {

    public static function register($metaInformationModel) {

        if ($metaInformationModel == null) {
            return;
        }

        $view = \Yii::$app->view;

        if(!empty($metaInformationModel->Keywords)) {
            $view->registerMetaTag([
                "name" => "keywords",
                "content" => $metaInformationModel->Keywords,
                ]);
        }

        if(!empty($metaInformationModel->Description)) {
            $view->registerMetaTag([
                "name" => "description",
                "content" => $metaInformationModel->Description,
                ]);
        }
    }

}
