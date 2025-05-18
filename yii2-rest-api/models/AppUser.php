<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $created_at
 * @property string $birth_date
 * @property string|null $updated_at
 * @property int $role_id
 *
 * @property Book[] $books
 * @property Role $roles
 * @property Sale[] $sales
 */
class AppUser extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'birth_date', 'role_id'], 'required'],
            [['created_at', 'birth_date', 'updated_at'], 'safe'],
            [['role_id'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
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
            'role_id' => 'Role ID',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Roles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sale::class, ['client_id' => 'id']);
    }

}
