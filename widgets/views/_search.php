<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\Article */
/* @var $searchUrl String */

?>

<div class="type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'enableClientValidation' => FALSE
    ]); ?>

    <div class="form-group">
        <?php
        echo $form->field($searchModel, 'searchQuery')->widget(\kartik\select2\Select2::classname(), [
            'size' => \kartik\select2\Select2::SMALL,
            'options' => ['placeholder' => Yii::t('app', 'You can use "category:name" to search by category.'), 'multiple' => false],
            'pluginOptions' => [
                'tags' => true,
                'allowClear' => true,
                'ajax' => [
                    'url' => $searchUrl,
                    'dataType' => 'json',
                    'data' => new \yii\web\JsExpression('function(params) {
                                                                            var paramObj = {};
                                                                            $.each($(\'#'.$form->getId().'\').serializeArray(), function(_, kv) {
                                                                              paramObj[kv.name] = params.term;
                                                                            });
                                                                            return paramObj;
                                                                           }')
                ],
                'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                'templateResult' => new \yii\web\JsExpression('function(data) { return data.text; }'),
                'templateSelection' => new \yii\web\JsExpression('function (data) { return data.text; }'),
            ],
        ]);

        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>