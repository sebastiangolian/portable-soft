<?php

use app\models\Calendar;
use kartik\color\ColorInput;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Calendar */
/* @var $form ActiveForm */
?>

<div class="calendar-form">
    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'start')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'end')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'color')->widget(ColorInput::classname(), [
                    'options' => [
                        'placeholder' => 'Wybierz kolor...',   
                    ],
                ]); ?>
                <?= $form->field($model, 'textColor')->widget(ColorInput::classname(), [
                    'options' => [
                        'placeholder' => 'Wybierz kolor...',   
                    ],
                ]); ?>
            
                <?= $form->field($model, 'repeat')->checkbox(); ?>
                <?= $form->field($model, 'add_counter')->checkbox(); ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Zapisz', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <?php
                    if(!$model->isNewRecord){
                        echo Html::a('Usuń', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Czy napewno chcesz usunąć wydarzenie ?',
                            'method' => 'post',
                        ],
                    ]);} ?>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
        
        <div class="col-md-6">
            <div class="well">
                <?= Html::radioList('eventColor',0, [
                    0 => 'Standardowy',
                    1 => 'Bieganie',
                    2 => 'Urodziny', 
                    3 => 'Imieniny',
                    4 => 'Rocznice',
                    5 => 'Święta'
                ], 
                ['itemOptions'=>['onchange' => 'colorChange(this.value);','labelOptions'=>['style'=>'display: block;']],]) ?>
            </div>
            
            <?php if(!$model->isNewRecord): ?>
                <?= $this->render('/calendar/_reminders', ['dataProvider' => $dataProvider,'calendar_id'=>$model->id]) ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php
$script = 
<<< JS
function colorChange(type)
{   
    switch(type)
    {
        case '0':
            $("#calendar-color").val('#5EA2CA'); 
            $('#calendar-color-cont .sp-preview-inner').css("background-color", "#5EA2CA");
            break;
        case '1':
            $("#calendar-color").val('#000000'); 
            $('#calendar-color-cont .sp-preview-inner').css("background-color", "#000000");
            break;
        case '2':
            $("#calendar-color").val('#50CE5D'); 
            $('#calendar-color-cont .sp-preview-inner').css("background-color", "#50CE5D"); 
            break;
        case '3':
            $("#calendar-color").val('#9350CE'); 
            $('#calendar-color-cont .sp-preview-inner').css("background-color", "#9350CE");
            break;
        case '4':
            $("#calendar-color").val('#E2E038'); 
            $('#calendar-color-cont .sp-preview-inner').css("background-color", "#E2E038"); 
            break;
        case '5': 
            $("#calendar-color").val('#E53232'); 
            $('#calendar-color-cont .sp-preview-inner').css("background-color", "#E53232"); 
            break;
        default:
            $("#calendar-color").val('#5EA2CA'); 
            $('#calendar-color-cont .sp-preview-inner').css("background-color", "#5EA2CA");
    }
}
JS;
$this->registerJs($script,View::POS_HEAD);
?>