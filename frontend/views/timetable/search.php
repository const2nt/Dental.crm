<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;


$this->title = 'Найти график';
$this->params['breadcrumbs'][] = ['label' => 'График приемов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?=$this->title?></h2>

<?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => ['timetable/search'],
                    ]);
?>
<p>
    <?php
    echo DatePicker::widget([
        'language' => 'ru',
        'name' => 'from_date',
        'value' => date('d-m-Y', time()),
        'type' => DatePicker::TYPE_RANGE,
        'name2' => 'to_date',
        'value2' => date('d-m-Y', time()),
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy',
            'language' => 'ru'

        ]
    ]);
    ?>
</p>

<p>
    <?= Html::submitButton("Найти",['class' => 'btn btn-success'])?>
</p>
<?php ActiveForm::end(); ?>
<br>
<p>
    <?= Html::a('Записать на прием', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php
if(!empty($dates)) {
    echo $this->render('_timetable', [
            'dates' => $dates,
    ]);
}
?>




