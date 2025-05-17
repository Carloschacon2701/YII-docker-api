<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Books".
 *
 * @property int $id
 * @property string $title
 * @property int $author_id
 * @property string $published_date
 * @property string $description
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Book extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'author_id', 'published_date', 'description'], 'required'],
            [['author_id'], 'integer'],
            [['published_date', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author_id' => 'Author ID',
            'published_date' => 'Published Date',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
