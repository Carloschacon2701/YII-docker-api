<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales".
 *
 * @property int $id
 * @property int $book_id
 * @property int $client_id
 * @property string|null $sale_date
 * @property int $quantity
 * @property float $total_price
 *
 * @property Book $books
 * @property User $users
 */
class Sale extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'client_id', 'quantity', 'total_price'], 'required'],
            [['book_id', 'client_id', 'quantity'], 'integer'],
            [['sale_date'], 'safe'],
            [['total_price'], 'number'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'client_id' => 'Client ID',
            'sale_date' => 'Sale Date',
            'quantity' => 'Quantity',
            'total_price' => 'Total Price',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::class, ['id' => 'client_id']);
    }

}
