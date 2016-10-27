<?php

namespace matacms\metainformation\helpers;

/**
 * Description of MetaInformation
 *
 * @author mfiedorowicz
 */
class MetaInformationHelper {

    public static function register($metaInformationModel) {

        $view = \Yii::$app->view;

        if(!empty($metaInformationModel->Keywords)) {
            $view->registerMetaTag([
                "property" => "keywords",
                "content" => $metaInformationModel->Keywords,
                ]);
        }

        if(!empty($metaInformationModel->Description)) {
            $view->registerMetaTag([
                "property" => "description",
                "content" => $metaInformationModel->Description,
                ]);
        }
    }

}
