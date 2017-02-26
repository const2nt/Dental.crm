<?php
use yii\helpers\Html;

?>

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
