<?php

use yii\db\Migration;

/**
 * Class m240402_065639_add_blog_post_comments_count_field
 */
class m240402_065639_add_blog_post_comments_count_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog_posts}}', 'comments_count', $this->integer()->notNull());

        $this->update('{{%blog_posts}}', ['comments_count' => 0]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240402_065639_add_blog_post_comments_count_field cannot be reverted.\n";
        $this->dropColumn('{{%blog_posts}}', 'comments_count');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240402_065639_add_blog_post_comments_count_field cannot be reverted.\n";

        return false;
    }
    */
}
