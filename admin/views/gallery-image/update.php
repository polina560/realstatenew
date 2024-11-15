<?php

use common\components\helpers\UserUrl;
use common\models\GalleryImageSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\GalleryImage
 */

$this->title = Yii::t('app', 'Update Gallery Image: ') .  $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Galleries'), 'url' => ['/gallery/index']];
$this->params['breadcrumbs'][] = ['label' => $model->gallery->name, 'url' => ['/gallery/view', 'id' => $model->id_gallery]];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Gallery Images'),
    'url' => UserUrl::setFilters(GalleryImageSearch::class, ['index', 'id_gallery' => $model->gallery->id])
];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->title), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="gallery-image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => false]) ?>

</div>
