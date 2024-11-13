<?php

use common\widgets\AppActiveForm;
use kartik\icons\Icon;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/**
 * @var $this     yii\web\View
 * @var $model    common\models\GalleryImage
 * @var $form     AppActiveForm
 * @var $isCreate bool
 */
?>

<div class="gallery-image-form">

    <?php $form = AppActiveForm::begin() ?>

<!--    --><?php //= $form->field($model, 'id_gallery')->textInput() ?>

<!--    --><?php //= $form->field($model, 'img')->textInput(['maxlength' => true]);?>
    <?= $form->field($model, 'img')->widget(\admin\widgets\ckfinder\CKFinderInputFile::class);
//    textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php if ($isCreate) {
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Create New'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=create']
            );
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Return To List'),
                ['class' => 'btn btn-success', 'formaction' => Url::to(['gallery-image/index', 'id_gallery' => $model->id_gallery])]
            );
        } ?>
        <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php AppActiveForm::end() ?>

</div>
