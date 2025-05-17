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

        // Create the 'authors' table first to ensure the foreign key constraint can be created
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'birth_date' => $this->date()->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'published_date' => $this->date()->notNull(),
            'description' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-books-author_id',
            'books',
            'author_id',
            'authors',
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
