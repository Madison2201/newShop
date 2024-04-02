<?php

use yii\db\Migration;

/**
 * Class m240402_070132_add_user_phone_field
 */
class m240402_070132_add_user_phone_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'phone', $this->string());


        $this->createIndex('{{%idx-users-phone}}', '{{%user}}', 'phone', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240402_070132_add_user_phone_field cannot be reverted.\n";
        $this->dropColumn('{{%user}}', 'phone');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240402_070132_add_user_phone_field cannot be reverted.\n";

        return false;
    }
    */
}
