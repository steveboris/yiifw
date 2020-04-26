<?php


namespace app\models;


use yii\db\ActiveRecord;

class MyCustomer extends ActiveRecord
{
    //Override this function to return the really table name
    public static function tableName() {
        return "{{%customer}}";
    }

    public function rules()
    {
        return [
            [['username', 'email'], 'required']
        ];
    }
}