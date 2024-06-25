<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RawTechnics $model */

$this->title = 'Create Raw Technics';
$this->params['breadcrumbs'][] = ['label' => 'Raw Technics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-technics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
