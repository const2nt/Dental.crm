<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Timetable */

$this->title = 'Записать на прием';
$this->params['breadcrumbs'][] = ['label' => 'График приемов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
