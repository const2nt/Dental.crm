<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patients_treatments".
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $date
 * @property integer $tooth_id
 * @property string $services_id
 * @property integer $doctor_id
 */
class PatientsTreatments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patients_treatments';
    }

    public function beforeSave($insert)
    {
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['patient_id', 'date', 'tooth_id', 'services_id', 'doctor_id'], 'required'],
            [['tooth_id', 'services_id', 'doctor_id'], 'required'],
            [['patient_id', 'tooth_id', 'doctor_id'], 'integer'],
            [['date'], 'string', 'max'=>11],
            [['services_id'], 'string'],
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
            'tooth_id' => Yii::t('app', 'Tooth ID'),
            'services_id' => Yii::t('app', 'Services ID'),
            'doctor_id' => Yii::t('app', 'Doctor ID'),
        ];
    }
}
