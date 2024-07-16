<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Импорт техники (счет 21)"
?>
<div class="technics-import-form">
    <h1>Привет!</h1>

    <p>
        Для импорта списка техники прикрепи нужный файл и нажми кнопку "Импорт"
    </p>
    <p>
        <strong>ВНИМАНИЕ!</strong>Перед импортом обязательно проверьте в файле от бухгалтерии, что нет повторяющихся значений! Если они есть устраните дубликат!
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
