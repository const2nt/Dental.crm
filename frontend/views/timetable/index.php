<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'График приемов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--<?php // echo $this->render('_search', ['model' => $searchModel]); ?>-->

    <p>
        <?= Html::a('Записать на прием', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Найти график', ['search'], ['class' => 'btn btn-success']) ?>
    </p>
<!-- <?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        //'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            // 'id',
//            'date',
//            'start_time',
//            'end_time',
//            'patient_id',
//            'full_name',
//            'doctor_id',
//            // 'manager_id',
//             'notes:ntext',
//            // 'phone',
//            // 'primary',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?> - Default table -->
</div>

<?php
    foreach ($dates as $date){
        ?>

<details>
    <summary>Дата <b><?=date('d-m-Y', $date['date'])?></b></summary>
    <div>

     <?php
        foreach ($dates as $doctor) {
            if ($doctor['date'] == $date['date'] && (is_array($doctor['doctor_id']))) {
                foreach ($doctor ['doctor_id'] as $doc) {

                    ?>

                    <details>
                        <summary> Доктор <?= $doc ?></summary>
                        <table>
                            <tr>
                                <td>Время приема</td>
                                <td>Пациент</td>
                                <td>Телефон</td>
                                <td>№ Карты</td>
                                <td>Заметки</td>
                                <td></td>
                            </tr>

                            <?php
                            foreach ($doctor['patients'] as $patient) {
                                if ($patient['doctor_id'] == $doc) {
                                    ?>

                                    <tr>
                                        <td><?= $patient['start_time'] ?> -
                                            <?= $patient['end_time'] ?></td>
                                        <td><?= (empty($patient['patient_id'])) ? $patient['full_name'] : $patient['patient_id'] ?></td>
                                        <td><?= $patient['phone'] ?></td>
                                        <td><?= ($patient['primary'] == 1) ? "Первичный" : '' ?></td>
                                        <td><?= $patient['notes'] ?></td>
                                        <td>
                                            <div class="pull-right">
                                                <?= Html::a(Yii::t('app', 'подробнее'),
                                                    ['timetable/view', 'id' => $patient['id']],
                                                    ['class' => 'btn btn-success btn-xs']);
                                                ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>

                        </table>

                    </details>

                    <?php
                }
            }
        }
                ?>

    </div>
</details>

<?php
    }
        ?>



