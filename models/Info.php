<?php
namespace app\models;

use yii\db\ActiveRecord;

class Info extends ActiveRecord {
    public static function tableName () {
        return 'Info';

    }
    public function rules()
    {
        return [
            [['name', 'mobile_number'], 'required'],
            [['name', 'mobile_number'], 'string']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Full name',
            'mobile_number' => 'Phone number',
        ];
    }
}

