<?php

use common\components\helpers\UserUrl;
use common\models\GalleryImageSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\GalleryImage
 */

$this->title = Yii::t('app', 'Create Gallery Image');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Gallery Images'),
    'url' => UserUrl::setFilters(GalleryImageSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
