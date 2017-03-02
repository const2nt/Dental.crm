<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model common\models\Timetable */

$this->title = 'Записать на прием';
$this->params['breadcrumbs'][] = ['label' => 'График приемов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <p>
        <?=Html::a('Записать первичного', ['create'],
            [
                    'class' => 'btn btn-success',
                    'data' => [
            'method' => 'post',
            'params' => [
                'create'=>'create'
                        ],
                            ]
            ])
        ?>
        <?= Html::a(Yii::t('app', 'Найти пациента'),
            ['patient/index'],
            ['class' => 'btn btn-primary'])
        ?>
    </p>


<?php
if(isset($_POST['create']) == 'create'){
?>
<div class="timetable-create">



    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>
<?php }?>


