<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Patients */

$this->title = Yii::t('app', 'Создать карточку');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Журнал пациентов'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="patients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
