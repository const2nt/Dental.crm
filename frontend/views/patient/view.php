<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Patients */

$this->title = $this->title = Yii::t('app', 'Карточка: ') ./**if(!empty)**/ $model->lastname." ".$model->firstname." ".$model->middlename;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Журнал пациентов'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать карточку'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить карточку'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Записать на прием'),
            ['timetable/create'],
            [
                'class' => 'btn btn-success btn-md',
                'data' => [
                    'method' => 'post',
                    'params' => [
                        'patient_id' => $model->id,
                        'phone' => $model->phone,
                        'name' => $model->lastname." ".$model->firstname." ".$model->middlename,
                        'create'=>'create'
                    ],
                ],
            ]
        );
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'lastname',
            'firstname',
            'middlename',
            'patient_card',
            'registration_date'=>[
                    'label' => 'Дата регистрации',
                    'value' => date('d-M-Y',$model->registration_date)
            ],
            'gender'=>[
                    'label' => 'Пол',
                    'value' => ($model->gender == 0) ? "женский" : "мужской"
            ],
            'phone',
            'country',
            'region',
            'city',
            'address',
            'place_work',
            'notes',
        ],
    ]) ?>

</div>
