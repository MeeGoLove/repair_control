<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Mol $model */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'МОЛ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mol-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
