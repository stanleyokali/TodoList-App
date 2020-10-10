<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "todo".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $duedate
 */
class Todo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'todo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'description', 'duedate'], 'required'],
            [['id'], 'integer'],
            [['description'], 'string'],
            [['duedate'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'duedate' => 'Duedate',
        ];
    }
}
