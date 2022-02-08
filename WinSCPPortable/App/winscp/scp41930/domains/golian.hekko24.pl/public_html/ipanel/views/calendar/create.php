<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Calendar */

$this->title = 'Dodaj wydarzenie';
$this->params['breadcrumbs'][] = ['label' => 'Kalendarz', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
