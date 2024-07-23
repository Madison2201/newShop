<?php

use yii\db\Migration;

/**
 * Class m240402_064815_add_shop_product_description_field
 */
class m240402_064815_add_shop_product_description_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'description', $this->text()->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240402_064815_add_shop_product_description_field cannot be reverted.\n";
        $this->dropColumn('{{%shop_products}}', 'description');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240402_064815_add_shop_product_description_field cannot be reverted.\n";

        return false;
    }
    */
}
