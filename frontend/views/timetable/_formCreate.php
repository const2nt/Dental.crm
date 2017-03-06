<?php


use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */
/* @var $form yii\widgets\ActiveForm */
?>
<h2><?= isset($_POST['name']) ? "Записать на прием: ".$_POST['name'] : Html::encode($this->title) ?></h2>

<div class="timetable-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    echo '<label  style="margin-left: 50px;" class="control-label">Дата приема</label>';
    echo DatePicker::widget([
        'model'=> $model,
        'attribute'=>'date',
        'options' => ['placeholder' => 'Выбирите дату ...','value'=>date('d-M-Y',time()),],
        'pluginOptions' => [
            'todayHighlight' => true,
            'todayBtn' => true,
            'format' => 'dd-M-yyyy',
            'autoclose' => true,
        ]
    ]);
    ?>

    <?= $form->field($model, 'start_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_name')
        ->textInput(isset($_POST['name']) ?
            ['maxlength' => true, 'value'=>$_POST['name']] :
            ['maxlength' => true] ) ?>

    <?= isset($_POST['patient_id']) ? "" : $form->field($model, 'primary')->checkbox() ?>

    <?= $form->field($model, 'doctor_id')->dropDownList($doctors) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone')
        ->textInput(isset($_POST['phone']) ?
            ['maxlength' => true, 'value'=>$_POST['phone']] :
            ['maxlength' => true])
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить запись' : 'Сохранить изминения', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'patient_id')->label(false)
        ->hiddenInput(isset($_POST['patient_id']) ?
        ['value'=> $_POST['patient_id']] :
            ['value' =>''])
    ?>

    <?= $form->field($model, 'manager_id')->label(false)->hiddenInput(['value' => Yii::$app->user->id]) ?>

    <?php ActiveForm::end(); ?>

</div>
