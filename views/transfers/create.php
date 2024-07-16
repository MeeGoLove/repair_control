<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Transfers $model */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Выдачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
