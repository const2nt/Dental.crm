<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model common\models\Timetable */

$this->title = 'Записать на прием';
$this->params['breadcrumbs'][] = ['label' => 'График приемов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if (!empty($_POST)) :
        print_r($_POST['patient_id']);
        echo "<br>";
        print_r($_POST['phone']);
    ?>

    <?= DetailView::widget([
        'model' => $_POST,
        'attributes' => [
            'patient_id'=>[                      // the owner name of the model
                'label' => "FIO" ,
                'value' => $_POST['patient_id'],
        ],
            'phone',

        ],
    ]) ?>
    <?php endif; ?>
    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>
