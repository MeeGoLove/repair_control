<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Materials $model */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Расходные материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
