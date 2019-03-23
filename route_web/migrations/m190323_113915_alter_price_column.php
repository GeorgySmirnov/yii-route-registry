<?php

use yii\db\Migration;

/**
 * Class m190323_113915_alter_price_column
 */
class m190323_113915_alter_price_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('route', 'price', $this->money(19, 2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190323_113915_alter_price_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190323_113915_alter_price_column cannot be reverted.\n";

        return false;
    }
    */
}
