<?php

namespace app\models;

use app\traits\GetListTrait;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $client_id
 * @property string $name
 *
 * @property Client $client
 * @property Log[] $logs
 */
class User extends \yii\db\ActiveRecord
{
    use GetListTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'name'], 'required'],
            [['client_id'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Logs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::class, ['user_id' => 'id']);
    }
}
