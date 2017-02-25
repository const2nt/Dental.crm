<?php

use yii\db\Migration;

/**
 * Handles the creation of table `timetable`.
 */
class m170218_115658_create_timetable_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('timetable', [
            'id' => $this->primaryKey(),
            'date' => $this->integer(),
            'start_time' => $this->integer(),
            'end_time' => $this->integer(),
            'patient_id' => $this->integer(),
            'full_name' => $this->string(),
            'doctor_id' => $this->integer(),
            'manager_id' => $this->integer(),
            'notes' => $this->text(),
            'phone' => $this->string(25),
            'primary' => $this->integer(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('timetable');
    }
}
