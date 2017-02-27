<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Typeahead;

/* @var $this yii\web\View */
/* @var $model common\models\PatientsSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
//if (!empty($search)) {
//    echo "<pre>";
//    print_r($search);
//    echo "</pre>";
//}
?>
<h3><?=Yii::t('app', 'Найти пациента')?></h3>
<p>
   <?php
        $form = ActiveForm::begin();

        echo $form->field($model, 'search')->widget(Typeahead::classname(), [
            'options' => ['placeholder' => 'Введите ФИО, номер телефона или номер карточки'],
            'pluginOptions' => ['highlight'=>true],
            'dataset' => [
                [
                    'local' => $data,
                    'limit' => 10
                ]
            ]
        ]);

        echo Html::submitButton(
            Yii::t('app', 'Найти пациента'),
            ['class'=>'btn btn-success btn-md']
        );
        ActiveForm::end();
    ?>

</p>


<?php
if(count($search)>0){
    foreach ($search as $item) {
        ?>

        <div class="panel panel-default">
            <div class="panel-body">
                <?= Html::a('<b>'.$item->lastname .
                    ' ' .
                    $item->firstname .
                    ' ' .
                    $item->middlename .
                    '</b> №карточки ' .
                    $item->patient_card,
                    ['patient/view', 'id' => $item->id]) ?>
                <div class="pull-right">
                    <?= Html::a(Yii::t('app', 'подробнее'),
                        ['patient/view', 'id' => $item->id],
                        ['class' => 'btn btn-success btn-xs']);
                    ?>
                    <?= Html::a(Yii::t('app', 'Записать на прием'),
                        ['timetable/create'],
                        [
                            'class' => 'btn btn-primary btn-xs',
                            'data' => [
                                'method' => 'post',
                                'params' => [
                                    'patient_id' => $item->id,
                                    'phone' => $item->phone
                                ],
                            ],
                        ]
//                        ['timetable/create'],
//                        ['class' => 'btn btn-primary btn-xs']
                        );
                    ?>
                </div>
            </div>
        </div>

        <?php
    }
}else{
    ?>
    <div class="alert alert-info">
        <?=Yii::t('app','NO search results')?>
    </div>
    <?php

}

?>

