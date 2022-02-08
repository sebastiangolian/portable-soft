<?php

use app\models\CalendarSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $searchModel CalendarSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Kalendarz';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title:ntext',
            'start',
            'end',
            'color',
            // 'textColor',
            // 'allDay',

            [
                'header'=> Html::a('<span class="glyphicon glyphicon-plus"></span>',Url::to(['calendar/create/']), ['title' => 'Dodaj nowy']),
                'class' => 'yii\grid\ActionColumn',
                'contentOptions'=> ['style'=>'width: 80px;'],
            ],
        ],
    ]); ?>
</div>
