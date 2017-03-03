<?php

use yii\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Typeahead;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Журнал пациентов');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div >
        <div class="patients-index row">
        <p>
                <?= Html::a(Yii::t('app', 'Создать карточку'),
                    ['create'],
                    ['class' => 'btn btn-success']) ?>
        </p>
        </div>
    </div>

        <div  class="panel-body">
            <?= $this->render('_search',[
                'model'=>$model,
                'data'=>$data,
                'search'=>$search
            ])?>

        </div>



<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'lastname',
        'firstname',
        'middlename',
        'phone',
        'patient_card',
        'notes:text',


        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>

