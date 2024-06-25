<?php

use app\models\RawTechnics;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Raw Technics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-technics-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Raw Technics', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'date_accounting',
            'date_manufacture',
            'inventory_number',
            //'invent_card',
            //'serial_number',
            //'mol_id',
            //'unit_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RawTechnics $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
