<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Transfers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transfers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inventory_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?php
    $unitsModel = \app\models\Units::find()->asArray()->all();
    $units = ArrayHelper::map($unitsModel,'id', 'name');
    ?>

    <?= $form->field($model, 'unit_id')->dropDownList($units, ) ?>

    <?php
        $tables = ArrayHelper::map([
                ['id' => 'technics','name' => 'Техника на выдачу'],

                ['id' => 'materials','name' => 'Расходные материалы'],

                ['id' => 'raw_technics','name' => 'RAW техника']]
        , 'id', 'name' );
    ?>

    <?= $form->field($model, 'ref_table_name')->dropDownList($tables,) ?>

    <?= $form->field($model, 'ref_table_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
