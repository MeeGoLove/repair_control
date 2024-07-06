<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Technics $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="technics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_accounting')->textInput() ?>

    <?= $form->field($model, 'invent_card')->textInput() ?>

    <?= $form->field($model, 'inventory_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'alternative_names')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_add')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
