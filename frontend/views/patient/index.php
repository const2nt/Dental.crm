<?php

use yii\helpers\Html;

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
        <div class="row" id="searchPatient">
            <?= $this->render('_search',[
                'model'=>$model,
                'data'=>$data,
                'search'=>$search
            ])?>

        </div>
    </div>

