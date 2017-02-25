<?php

use yii\db\Migration;

/**
 * Handles the creation of table `patient_profile`.
 */
class m170218_115757_create_patient_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('patient_profile', [
            'patient_id' => $this->primaryKey(),
            'phone' => $this->string(25),
            'country' => $this->string(50),
            'region' => $this->string(50),
            'city' => $this->string(50),
            'address' => $this->text(),
            'place_work' => $this->text(),
            'notes' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('patient_profile');
    }
}
