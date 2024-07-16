<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Импорт техники"
?>
<div class="technics-import-form">
    <h1>Привет!</h1>

    <p>
        Для импорта списка техники прикрепи нужный файл и нажми кнопку "Импорт"
    </p>
    <?php
    $form = ActiveForm::begin();
    ?>
    <?= $form->field($model, 'importFile')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
