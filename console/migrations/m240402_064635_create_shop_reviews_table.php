<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_reviews}}`.
 */
class m240402_064635_create_shop_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_reviews}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'vote' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull(),
        ]);
        $this->createIndex('{{%idx-shop_reviews-user_id}}', '{{%shop_reviews}}', 'user_id');

        $this->addForeignKey('{{%fk-shop_reviews-user_id}}', '{{%shop_reviews}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_reviews}}');
    }
}
