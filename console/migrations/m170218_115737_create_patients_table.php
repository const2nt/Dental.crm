<?php

use yii\db\Migration;

/**
 * Handles the creation of table `patients`.
 */
class m170218_115737_create_patients_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('patients', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(50),
            'lastname' => $this->string(50),
            'middlename' => $this->string(50),
            'patient_card' => $this->integer(7),
            'registration_date' => $this->integer(),
            'gender' => $this->integer(1),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('patients');
    }
}
