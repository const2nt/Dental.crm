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
                          <summary> <b>Доктор</b> <?php
                                    foreach($doctor['doctors_profile'] as $profile){
                                        if ($profile['user_id'] == $doc){
                                            echo $profile['lastname']." ".
                                                $profile['firstname']." ".
                                                $profile['middlename'];
                                        }
}
                                ?>
                            </summary>
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
                                            <td><?php
                                                foreach($doctor['patients_profile'] as $profile)
                                                {
                                                    if ($profile['id'] == $patient['patient_id'])
                                                    {
                                                        echo $profile['lastname']." ".
                                                            $profile['firstname']." ".
                                                            $profile['middlename'];
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?= $patient['phone'] ?></td>
                                            <td><?php
                                                foreach($doctor['patients_profile'] as $profile)
                                                {
                                                    if ($profile['id'] == $patient['patient_id'])
                                                    {
                                                    echo $profile['patient_card'];
                                                }
                                                }
                                                ?>
                                            </td>
                                            <td><?= $patient['notes'] ?></td>
                                            <td>
                                                <div class="pull-right">
                                                    <?= Html::a(Yii::t('app', 'подробнее'),
                                                        ['timetable/view', 'id' => $patient['id']],
                                                        ['class' => 'btn btn-success btn-xs']);?>
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