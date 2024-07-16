<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Technics $model */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Техника на выдачу', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
