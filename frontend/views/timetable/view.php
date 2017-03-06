<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'График приемов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-view">

    <h1><?=$profile->lastname." ".$profile->firstname." ".$profile->middlename ?></h1>

    <p>
        <?= Html::a('Редактировать прием', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить с приема', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Карточка'), ['patient/view', 'id' => $model->patient_id], ['class' => 'btn btn-info']) ?>

    </p>
    <?php
//    echo "<pre>";
//    print_r($model);
//    print_r($profile);
//    echo "</pre>";
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'date' =>[
                'label'=>Yii::t('app','Дата приема'),
                'value'=>date('d-M-Y',$model->date)
            ],
            'start_time'=>[
                'label'=>Yii::t('app','Начало приема'),
                'value'=>$model->start_time
            ],
            'end_time' =>[
                'label'=>Yii::t('app','Конец приема'),
                'value'=>$model->end_time
            ],
//            'patient_id',
            'full_name'=>[
                'label'=>Yii::t('app','ФИО'),
                'value'=>$profile->lastname." ".$profile->firstname." ".$profile->middlename
            ],
            'doctor_id'=>[
                'label'=>Yii::t('app','Доктор'),
                'value'=>$doctor->lastname." ".$doctor->firstname." ".$doctor->middlename
            ],
            'manager_id'=>[
                'label'=>Yii::t('app','Менеджер'),
                'value'=>$manager->lastname." ".$manager->firstname." ".$manager->middlename
            ],
            'notes:ntext',
            'phone',
            'primary'=>[
                'label'=>Yii::t('app','Номер карточки'),
                'value'=>$profile->patient_card
            ],
        ],
    ]) ?>

</div>
