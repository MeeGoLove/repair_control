<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Mol $model */

$this->title = 'Update Mol: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mols', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mol-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
