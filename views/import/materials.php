<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Импорт расходных материалов"
?>
<div class="materials-import-form">
    <h1>Привет!</h1>

    <p>
        Для импорта списка расходных материалов прикрепи нужный файл и нажми кнопку "Импорт"
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
