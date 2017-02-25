<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patients".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $middlename
 * @property integer $patient_card
 * @property integer $registration_date
 * @property integer $gender
 */
class Patients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_card', 'registration_date', 'gender'], 'integer'],
            [['firstname', 'lastname', 'middlename'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'middlename' => 'Middlename',
            'patient_card' => 'Patient Card',
            'registration_date' => 'Registration Date',
            'gender' => 'Gender',
        ];
    }
}
