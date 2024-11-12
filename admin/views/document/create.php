<?php

use common\components\helpers\UserUrl;
use common\models\DocumentSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Document
 */

$this->title = Yii::t('app', 'Create Document');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Documents'),
    'url' => UserUrl::setFilters(DocumentSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
