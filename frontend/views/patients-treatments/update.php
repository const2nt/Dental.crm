<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PatientsDiagnoses */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Patients Diagnoses',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patients Diagnoses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="patients-diagnoses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'diagnoses' => $diagnoses,
        'treatments' => $treatments,
        'services'=> $services,
        'patients' => $patients
    ]) ?>

</div>
