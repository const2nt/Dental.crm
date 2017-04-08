<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patients_diagnoses".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $date
 * @property integer $tooth_id
 * @property string $diagnoses_id
 * @property integer $doctor_id
 *
 */
class PatientsDiagnoses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patients_diagnoses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patient_id', 'date', 'tooth_id', 'diagnoses_id', 'doctor_id'], 'required'],
            [['patient_id', 'tooth_id', 'doctor_id', 'timetable_id'], 'integer'],
            [['date'], 'string', 'max'=>11],
            [['diagnoses_id'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'patient_id' => Yii::t('app', 'Patient ID'),
            'date' => Yii::t('app', 'Date'),
            'tooth_id' => Yii::t('app', 'Номер диагностированого зуба'),
            'diagnoses_id' => Yii::t('app', 'Диагноз'),
            'doctor_id' => Yii::t('app', 'Doctor ID'),
            'timetable_id' => Yii::t('app', 'Timetable ID'),

        ];
    }
}
