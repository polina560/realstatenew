<?php

use admin\components\widgets\detailView\Column;
use admin\components\widgets\detailView\ColumnImage;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\GalleryImageSearch;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\GalleryImage
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Galleries'), 'url' => ['/gallery/index']];
$this->params['breadcrumbs'][] = ['label' => $model->gallery->name, 'url' => ['/gallery/view', 'id' => $model->id_gallery]];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Gallery Images'),
    'url' => UserUrl::setFilters(GalleryImageSearch::class, ['index', 'id_gallery' => $model->gallery->id])
];

$this->params['breadcrumbs'][] = RbacHtml::encode($this->title);
?>
<div class="gallery-image-view">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <p>
        <?= RbacHtml::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= RbacHtml::a(
            Yii::t('app', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post'
                ]
            ]
        ) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            Column::widget(),
            Column::widget(['attr' => 'id_gallery', 'viewAttr' => 'gallery.name']),
            ColumnImage::widget(['attr' => 'img']),
            Column::widget(['attr' => 'title']),
            Column::widget(['attr' => 'text', 'format' => 'ntext']),
        ]
    ]) ?>

</div>
