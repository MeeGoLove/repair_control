<?php

use app\models\Materials;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\MaterialsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Расходные материалы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materials-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Импорт', ['/import/materials'], ['class' => 'btn btn-info']) ?>
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
            'count',
            'alternative_names',
            'date_add',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Materials $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'headerOptions' => ['style' => 'width:180px'],
                'template' => '{transfer}',
                'buttons' => [
                    'format' => 'raw',
                    'transfer' =>
                        function ($url, $model, $key) {
                            $name = $model->name;
                            return  Html::a('Оформить выдачу',
                                ['transfers/create-from', 'id' => $model->id, 'refTable' => 'materials'], [
                                'class' => 'btn btn-success',
                                'title' => 'Оформить выдачу',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                        }]]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
