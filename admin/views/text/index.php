<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\editable\Editable;
use kartik\grid\SerialColumn;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\TextSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Text
 */

$this->title = Yii::t('app', 'Texts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

<!--     -->

    <div>
    <?=
    RbacHtml::a(Yii::t('app', 'Create Text'), ['create'], ['class' => 'btn btn-success']);
    //           $this->render('_create_modal', ['model' => $model]);
    ?>
</div>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            Column::widget(),

            'key' => [
                'attribute' => 'Key',
                'value' => function ($model) {
                    $const = new \common\models\TextStatus();
                    return $const->getDeletableName($model->key);

                }
            ],
            Column::widget(['attr' => 'value', 'format' => 'html', 'width' => 700, 'type' => Editable::INPUT_TEXTAREA]),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
