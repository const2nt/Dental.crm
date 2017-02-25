<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "patient_profile".
 *
 * @property integer $patient_id
 * @property string $phone
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $address
 * @property string $place_work
 * @property string $notes
 */
class PatientProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'place_work', 'notes'], 'string'],
            [['phone'], 'string', 'max' => 25],
            [['country', 'region', 'city'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'patient_id' => 'Patient ID',
            'phone' => 'Phone',
            'country' => 'Country',
            'region' => 'Region',
            'city' => 'City',
            'address' => 'Address',
            'place_work' => 'Place Work',
            'notes' => 'Notes',
        ];
    }
}
