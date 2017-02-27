<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Журнал пациентов');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="patients-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Создать пациента'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_search',[
            'model'=>$model,
            'data'=>$data,
            'search'=>$search
    ])?>


    <?php
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
////            'id',
//            'lastname',
//            'firstname',
//            'middlename',
//            'patient_card',
//            // 'registration_date',
//            'gender',
//            'phone',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);
    ?>


</div>
