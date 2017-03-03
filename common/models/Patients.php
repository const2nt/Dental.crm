<?php

namespace common\models;

use frontend\controllers\PatientController;
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

    public function beforeSave($insert)
    {
        $this->patient_card = PatientController::getLastPatientCardNumber() + 1;
        $this->registration_date = strtotime($this->registration_date);


        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'middlename', 'registration_date', 'phone'], 'required'],
            [['patient_card', 'gender'], 'integer'],
            [['registration_date'], 'date', 'format' => 'dd-mm-yyyy' ],
            [['address', 'place_work', 'notes'], 'string'],
            [['firstname', 'lastname', 'middlename','country', 'region', 'city'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => Yii::t('app', 'Имя'),
            'lastname' => Yii::t('app', 'Фамилия'),
            'middlename' => Yii::t('app', 'Отчество'),
            'patient_card' => Yii::t('app', 'Номер карточки'),
            'registration_date' => Yii::t('app', 'Дата регистрации'),
            'gender' => Yii::t('app', 'Пол'),
            'phone' => Yii::t('app', 'Телефон'),
            'country' => Yii::t('app', 'Страна'),
            'region' => Yii::t('app', 'Область'),
            'city' => Yii::t('app', 'Город'),
            'address' => Yii::t('app', 'Адрес'),
            'place_work' => Yii::t('app', 'Место работы'),
            'notes' => Yii::t('app', 'Заметки'),
        ];
    }
}
