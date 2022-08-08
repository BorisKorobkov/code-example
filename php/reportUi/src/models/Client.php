<?php

namespace app\models;

use app\traits\GetListTrait;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $name
 * @property int $active
 *
 * @property User[] $users
 */
class Client extends \yii\db\ActiveRecord
{
    use GetListTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'active'], 'required'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 200],
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
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['client_id' => 'id']);
    }
}
