<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RawTechnics $model */

$this->title = 'Update Raw Technics: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Raw Technics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="raw-technics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
