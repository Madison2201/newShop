<?php

use yii\db\Migration;

/**
 * Class m240402_064853_add_shop_product_status_field
 */
class m240402_064853_add_shop_product_status_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'status', $this->smallInteger()->notNull());
        $this->update('{{%shop_products}}', ['status' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240402_064853_add_shop_product_status_field cannot be reverted.\n";
        $this->dropColumn('{{%shop_products}}', 'status');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240402_064853_add_shop_product_status_field cannot be reverted.\n";

        return false;
    }
    */
}
