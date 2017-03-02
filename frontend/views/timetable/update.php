<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */

$this->title = 'Редактировать запись : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'График приемов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать запись';
?>
<div class="timetable-update">

    <h2><?= $profile->lastname." ".$profile->firstname." ".$profile->middlename ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'doctors'=>$doctors
    ]) ?>

</div>
