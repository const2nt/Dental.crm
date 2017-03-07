<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Посешения на сегодня');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-diagnoses-index">

    <h1><?= Html::encode($this->title) ?>:</h1>

    <div class="panel panel-default" id="panel-result">
        <?php
        if ($patients != NULL) {
            foreach ($patients as $patient) {
                ?>
                <div class="panel-body">
                    <b><?= $patient['name'] ?></b>
                    <div class="pull-right">
                        <?= Html::a(Yii::t('app', 'Карточка'),
                            ['patient/view', 'id' => $patient['id']],
                            ['class' => 'btn btn-info btn-xs']);
                        ?>
                        <?= Html::a(Yii::t('app', 'Начать посешение'),
                            ['patients-treatments/create'],
                            [
                                'class' => 'btn btn-success btn-xs',
                                'data' => [
                                    'method' => 'post',
                                    'params' => [
                                        'patient_id' => $patient['id'],
                                        'name' => $patient['name']
                                    ],
                                ],
                            ]
                        );
                        ?>
                    </div>
                </div>
                <?php
            }
        }else{
            ?>
            <div class="panel-body">
                <h3>Нет осмотров</h3>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
    if ($patients != NULL) {
        ?>
        <h3>Осмотреные пациенты</h3>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'patient_id',
                'date',
                'tooth_id',
                'diagnoses_id:ntext',
                'doctor_id',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php
    }
    ?>
</div>
