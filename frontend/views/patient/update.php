<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Patients */

$this->title = Yii::t('app', 'Карточка: ') ./**if(!empty)**/ $model->lastname." ".$model->firstname." ".$model->middlename;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Журнал пациентов'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать карточку');
?>
<div class="patients-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
