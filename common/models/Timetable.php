<?php

namespace common\models;

use frontend\controllers\PatientController;
use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property integer $id
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $patient_id
 * @property string $full_name
 * @property integer $doctor_id
 * @property integer $manager_id
 * @property string $notes
 * @property string $phone
 * @property integer $primary
 */
class Timetable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timetable';
    }

    public function beforeSave($insert)
    {
        $this->date = strtotime($this->date);
        $this->full_name = NULL;
        if ($this->primary == 1 && $this->isNewRecord == true)
        {
            $name = explode(" ",$this->full_name);

            $model = new Patients();
            $model->lastname = $name[0];
            $model->firstname = $name[1];
            $model->middlename = $name[2];
            $model->registration_date = date('d-m-Y',time());
            $model->phone = $this->phone;
            $model->patient_card = PatientController::getLastPatientCardNumber() + 1;
            $model->save();

            $this->patient_id = $model->id;
            $this->full_name = NULL;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'string', 'max'=>11],
            [['start_time','end_time' ], 'string', 'max'=>5 ],
            [['patient_id', 'doctor_id', 'manager_id', 'primary'], 'integer'],
            [['date','start_time','end_time', 'doctor_id', 'manager_id'], 'required'],
            [['notes'], 'string'],
            [['full_name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Дата'),
            'start_time' => Yii::t('app', 'Начало приема'),
            'end_time' => Yii::t('app', 'Конец приема'),
            'patient_id' => Yii::t('app', 'ID пациента'),
            'full_name' => Yii::t('app', 'ФИО'),
            'doctor_id' => Yii::t('app', 'Выберите доктора'),
            'manager_id' => Yii::t('app', 'Менеджер'),
            'notes' => Yii::t('app', 'Заметки'),
            'phone' => Yii::t('app', 'Телефоный номер '),
            'primary' => Yii::t('app', 'Первичный'),
        ];
    }
}
