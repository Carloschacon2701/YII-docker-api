<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Authors".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $created_at
 * @property string $birth_date
 * @property string|null $updated_at
 */
class Author extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'birth_date'], 'required'],
            [['created_at', 'birth_date', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
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
            'email' => 'Email',
            'created_at' => 'Created At',
            'birth_date' => 'Birth Date',
            'updated_at' => 'Updated At',
        ];
    }

}
