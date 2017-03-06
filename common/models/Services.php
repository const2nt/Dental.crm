<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property integer $id
 * @property string $service_name
 * @property string $price
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_name', 'price'], 'required'],
            [['service_name'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 7],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service_name' => Yii::t('app', 'Service Name'),
            'price' => Yii::t('app', 'Price'),
        ];
    }
}
