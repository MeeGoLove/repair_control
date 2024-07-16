<?php

use app\models\Transfers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TransfersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Выдачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Для оформления выдачи перейдите на страничку <?= Html::a('техники на выдачу', ['/technics'])?> либо на страничку <?= Html::a('расходных материалов', ['/materials'])?> и выберите (найдите) нужную позицию и нажмите на кнопку "Выдать"
    <p>
        Для оформления выдачи техники не со склада АСУ перейдите на страничку <?= Html::a('Вся техника (RAW)', ['/raw-technics'])?> либо на страничку расходных материалов и выберите (найдите) нужную позицию и нажмите на кнопку "Выдать"
    </p>
        <?php # Html::a('Создать (не нажимать! не работает!)', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'comment',
            'inventory_number',
            'serial_number',
            'count',
            'date',
            'unit_id',
            //'ref_table_name',
            //'ref_table_id',
            'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Transfers $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
