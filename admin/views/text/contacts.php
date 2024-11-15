<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use common\models\Text;
use kartik\editable\Editable;
use kartik\grid\SerialColumn;
use kartik\icons\Icon;
use yii\helpers\Html;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\TextSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Text
 */

$this->title = Yii::t('app', 'Texts');
$this->params['breadcrumbs'][] = $this->title;
$readonly = fn(Text $text) => !$text->deletable
?>
<div class="text-contacts">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?= $this->render('_create_modal', ['model' => $model]); ?>
    </div>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            Column::widget(),
            Column::widget(['attr' => 'group', 'readonly' => $readonly]),
            Column::widget(['attr' => 'key', 'readonly' => $readonly]),
            Column::widget(['attr' => 'value', 'format' => 'html', 'width' => 700, 'type' => Editable::INPUT_TEXTAREA]),
            Column::widget(['attr' => 'comment']),

            [
                'class' => GroupedActionColumn::class,
                'buttons' => [
                    'delete' => function ($url, Text $model) {
                        if (!$model->deletable) {
                            return null;
                        }
                        return RbacHtml::a(Icon::show('trash-alt'), $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-bs-toggle' => 'tooltip',
                            'class' => 'text-danger',
                            'data-pjax' => '0',
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post'
                        ]);
                    }
                ]
            ]
        ]
    ]) ?>
</div>
