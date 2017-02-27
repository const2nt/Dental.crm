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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать прием', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить с приема', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'date' =>[
                'label'=>Yii::t('app','Дата приема'),
                'value'=>date('d-m-Y',$date)
            ],
            'start_time'=>[
                'label'=>Yii::t('app','Начало приема'),
                'value'=>$start_time
            ],
            'end_time' =>[
                'label'=>Yii::t('app','Конец приема'),
                'value'=>$end_time
            ],
            'patient_id',
            'full_name',
            'doctor_id',
            'manager_id',
            'notes:ntext',
            'phone',
//            'primary',
        ],
    ]) ?>

</div>
