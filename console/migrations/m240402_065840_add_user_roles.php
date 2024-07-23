<?php

use yii\db\Migration;

/**
 * Class m240402_065840_add_user_roles
 */
class m240402_065840_add_user_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->batchInsert('{{%auth_items}}', ['type', 'name', 'description'], [
//            [1, 'user', 'User'],
//            [1, 'admin', 'Admin'],
//        ]);
//
//        $this->batchInsert('{{%auth_item_children}}', ['parent', 'child'], [
//            ['admin', 'user'],
//        ]);
//
//        $this->execute('INSERT INTO {{%auth_assignments}} (item_name, user_id) SELECT \'user\', u.id FROM {{%user}} u ORDER BY u.id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240402_065840_add_user_roles cannot be reverted.\n";
        $this->delete('{{%auth_items}}', ['name' => ['user', 'admin']]);
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240402_065840_add_user_roles cannot be reverted.\n";

        return false;
    }
    */
}
