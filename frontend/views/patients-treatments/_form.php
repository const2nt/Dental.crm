<?php

use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PatientsDiagnoses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patients-diagnoses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($diagnoses, 'patient_id')->hiddenInput(['value' => $_POST['patient_id']])->label(false)?>

    <h3>Диагноз</h3>

    <?= $form->field($diagnoses, 'date')->hiddenInput(['value' => strtotime(date('d-m-Y',time()))])->label(false) ?>

    <?= $form->field($diagnoses, 'tooth_id')->textInput() ?>

    <?= $form->field($diagnoses, 'diagnoses_id')->textarea(['rows' => 3]) ?>

    <?= $form->field($diagnoses, 'doctor_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <h3>Лечение</h3>

    <?= $form->field($treatments, 'patient_id')->hiddenInput(['value' => $_POST['patient_id']])->label(false)?>

    <?= $form->field($treatments, 'date')->hiddenInput(['value' => strtotime(date('d-m-Y',time()))])->label(false) ?>

    <?= $form->field($treatments, 'tooth_id')->textInput()->label('Номер лечебного зуба') ?>
<?php
    echo '<label class="control-label">Применино в личении</label>';
    echo Select2::widget([
    'name' => 'services_id',
    'data' => $services,
    'size' => Select2::THEME_BOOTSTRAP,
    'options' => ['placeholder' => 'Добавьте из списка', 'multiple' => true],
    'pluginOptions' => [
    'allowClear' => true
    ],
    ])
?>
    <?= $form->field($treatments, 'doctor_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($diagnoses->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $diagnoses->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
