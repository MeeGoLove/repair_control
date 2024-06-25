<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = "Импорт из Radmin"
?>
<div class="raw-import-form">
    <h1>Привет!</h1>

    <p>
        Для импорта сырого списка оборудования прикрепи нужный файл и нажми кнопку "Импорт"
    </p>
    <p>
        ВНИМАНИЕ! Таблица с сырыми записями будет стерта и заново перезаписана! Данные других таблиц затронуты не будут!
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
