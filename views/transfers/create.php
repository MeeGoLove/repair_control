<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Transfers $model */

$this->title = 'Create Transfers';
$this->params['breadcrumbs'][] = ['label' => 'Transfers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
