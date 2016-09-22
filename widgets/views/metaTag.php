<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use mata\widgets\sortable\Sortable;

?>

<label class="control-label">Related Content</label>

<?php

$itemsContents = [];
$idx = 0;
foreach($items as $item):
    $itemsContents[] = ['content' => '<div class="related-content-item field-relatedcontent-text-' . $idx .'">
        <textarea class="related-content-text" name="RelatedContent[' . $item->Id . '][Text]" id="relatedcontent-text-' . $idx .'">' . $item->Text .'</textarea>
        <div class="help-block">' . $item->getFirstError('Text') . '</div>
        <input class="related-content-order" type="hidden" name="RelatedContent[' . $item->Id .'][_order]" value="' . $item->getOrder() .'">
    </div>'];

    $this->registerJs("jQuery('#" . $selectorPrefix . 'text-' . $idx . "').redactor(matacms.relatedContent.redactorOptions);");

    $options = [];

    foreach($clientValidations as $clientValidation) {
        $clientValidation['id'] = $clientValidation['id'] . "-" . $idx;
        $clientValidation['input'] = $clientValidation['input'] . "-" . $idx;
        $clientValidation['container'] = $clientValidation['container'] . "-" . $idx;
        $clientValidation['error'] = '.help-block';

        $options[] = $clientValidation;
    }

    $form->attributes = array_merge($form->attributes, $options);

    $idx++;
endforeach;
?>

<div id="related-content-container">
    <?= Sortable::widget([
        'type' => 'list',
        'id' => 'related-content-sortable',
        'items' => $itemsContents,
        'showHandle' => true,
        'pluginOptions' => [
            'forcePlaceholderSize' => true
        ]
    ]); ?>
</div>
<a  href="javascript:void(0)" class="btn btn-primary" id="add-related-content">Add</a>
