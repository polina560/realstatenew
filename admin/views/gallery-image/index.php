<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\GalleryImageSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\GalleryImage
 */

$this->title = Yii::t('app', 'Gallery Images');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Galleries'), 'url' => ['/gallery/index']];
$this->params['breadcrumbs'][] = ['label' => $searchModel->gallery->name, 'url' => ['/gallery/view', 'id' => $searchModel->id_gallery]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-image-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?=
            RbacHtml::a(Yii::t('app', 'Create Gallery Image'), ['create', 'id_gallery'=>$searchModel->gallery->id], ['class' => 'btn btn-success']);
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
            Column::widget(['attr' => 'id_gallery']),
            Column::widget(['attr' => 'img']),
            Column::widget(['attr' => 'title']),
            Column::widget(['attr' => 'text', 'format' => 'ntext']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
