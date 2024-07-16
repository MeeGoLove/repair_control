<?php

use app\models\RawTechnics;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\RawTechnicsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Raw Technics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-technics-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Импортировать данные с файла Excel', ['import/raw'], ['class' => 'btn btn-success']) ?>
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
            //'date_accounting',
            //'date_manufacture',
            'inventory_number',
            //'invent_card',
            'serial_number',
            //'mol_id',
            //'unit_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RawTechnics $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'headerOptions' => ['style' => 'width:150px']

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
