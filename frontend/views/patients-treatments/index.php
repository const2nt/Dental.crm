<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Patients Diagnoses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-diagnoses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Patients Diagnoses'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'patient_id',
            'date',
            'tooth_id',
            'diagnoses_id:ntext',
            // 'doctor_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
