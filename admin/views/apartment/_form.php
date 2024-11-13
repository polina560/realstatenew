<?php

use admin\widgets\dynamicForm\DynamicFormHelper;
use admin\widgets\dynamicForm\DynamicFormWidget;
use common\widgets\AppActiveForm;
use kartik\icons\Icon;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/**
 * @var $this     yii\web\View
 * @var $modelApartment     common\models\Apartment
 * @var $modelsRooms    common\models\Room[]
 * @var $form     AppActiveForm
 * @var $isCreate bool
 */
?>

<div class="apartment-form">

    <?php $form = AppActiveForm::begin(['id' => 'dynamic-form']) ?>

    <?= $form->field($modelApartment, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelApartment, 'subtitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelApartment, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelApartment, 'price')->textInput() ?>

    <?= $form->field($modelApartment, 'floor')->textInput() ?>

    <?= $form->field($modelApartment, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelApartment, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelApartment, 'add_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelApartment, 'add_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelApartment, 'API_flag')->textInput() ?>


    <?=
    $form->field($modelApartment, 'API_flag')->dropDownList(array_column(\common\enums\Boolean::class::cases(), 'name'));
    ?>

    <div class="panel panel-default">
        <!--        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Комнаты </h4></div>-->
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class.
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' =>  $modelsRooms[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'title',
                    'area',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsRooms as $i => $modelRoom): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <br>
                            <h3 class="panel-title pull-left">Комната</h3>
                            <div class="pull-right">
                                <?= DynamicFormHelper::plusButton('add-item') ?>
                                <?= DynamicFormHelper::minusButton('remove-item') ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (! $modelRoom->isNewRecord) {
                                echo Html::activeHiddenInput($modelRoom, "[{$i}]id");
                            }
                            ?>

                            <div class="row">

                                <div class="col-sm-6">
                                    <?= $form->field($modelRoom, "[{$i}]title")->textInput(['maxlength' => true]) ?>

                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelRoom, "[{$i}]area")->textInput() ?>

                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelRoom, "[{$i}]uid")->textInput() ?>

                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?php if ($isCreate) {
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

    <?php AppActiveForm::end() ?>

</div>
