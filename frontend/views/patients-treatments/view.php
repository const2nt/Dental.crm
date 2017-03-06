<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PatientsDiagnoses */

$this->title = $diagnoses->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patients Diagnoses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-diagnoses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $diagnoses->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $diagnoses->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $diagnoses,
        'attributes' => [
            'id',
            'patient_id',
            'date'=>[
                'label'=>"Дата",
                'value'=>date('d-M-Y',$diagnoses->date)
            ],
            'tooth_id',
            'diagnoses_id:ntext',
            'doctor_id',
        ],
    ]) ?>
    <?= DetailView::widget([
        'model' => $treatments,
        'attributes' => [
            'id',
            'patient_id',
            'date'=>[
                'label'=>"Дата",
                'value'=>date('d-M-Y',$diagnoses->date)
            ],
            'tooth_id',
            'services_id:ntext',
            'doctor_id',
        ],
    ]) ?>

</div>
