<?php

use app\models\Technics;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TechnicsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Техника на выдачу';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technics-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Импорт', ['/import/technics'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Импорт (счет 21)', ['/import/technics-z21'], ['class' => 'btn btn-info']) ?>
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
            //'invent_card',
            'inventory_number',
            'serial_number',
            'count',
            'alternative_names',
            'date_add',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Technics $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
