<?php

use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timetable-form">

    <?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'date')
->textInput([
'maxlength' => true,
 'value'=>date('d-m-Y', $model->date)])
 ?>

<!--    <?php
//    echo DatePicker::widget([
//        'name' => 'dp_1',
//        'type' => DatePicker::TYPE_INPUT,
//        'value' => date('d-M-Y', $model->date),
//        'pluginOptions' => [
//            'autoclose'=>true,
//            'format' => 'dd-mm-yyyy',
//        ]
//    ]);
//    ?>-->

    <?= $form->field($model, 'start_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doctor_id')->dropDownList($doctors) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить запись' : 'Сохранить изминения', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
