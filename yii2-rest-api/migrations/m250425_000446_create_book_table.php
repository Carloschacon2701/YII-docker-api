<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m250425_000446_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('roles', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        // Create the 'authors' table first to ensure the foreign key constraint can be created
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'birth_date' => $this->date()->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            'role_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('status', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'published_date' => $this->date()->notNull(),
            'description' => $this->text()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('status_books', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'active' => $this->boolean()->notNull()->defaultValue(1),
        ]);

        $this->createTable('sales', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'client_id' => $this->integer()->notNull(),
            'sale_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'quantity' => $this->integer()->notNull(),
            'total_price' => $this->decimal(10, 2)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-books-author_id',
            'books',
            'author_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-status_books-book_id',
            'status_books',
            'book_id',
            'books',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-status_books-status_id',
            'status_books',
            'status_id',
            'status',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-sales-book_id',
            'sales',
            'book_id',
            'books',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-sales-client_id',
            'sales',
            'client_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-users-role_id',
            'users',
            'role_id',
            'roles',
            'id',
            'CASCADE',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-books-author_id',
            'books'
        );
        $this->dropTable('authors');
        $this->dropTable('books');
    }
}
