<?php

use common\widgets\AppActiveForm;
use kartik\icons\Icon;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/**
 * @var $this     yii\web\View
 * @var $model    common\models\Text
 * @var $form     AppActiveForm
 * @var $isCreate bool
 */
?>

<div class="text-form">

    <?php
    $form = AppActiveForm::begin() ?>
    <?php if ($model->deletable): ?>
        <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'group')->dropDownList(['contacts' => 'Контакты', null => 'Без группы']); ?>
    <?php endif ?>

    <?= $form->field($model, 'value')
        ->widget(\admin\widgets\ckeditor\EditorClassic::class);
//        ->textarea(['rows' => count(explode(PHP_EOL, (string)$model->value))]) ?>

    <?= $form->field($model, 'comment')
        ->textarea(['rows' => count(explode(PHP_EOL, (string)$model->value))]) ?>


    <div class="form-group">
        <?php
        if ($isCreate) {
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Create New'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=create']
            );
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Return To List'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=index']
            );
        } ?>
        <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    AppActiveForm::end() ?>

</div>
