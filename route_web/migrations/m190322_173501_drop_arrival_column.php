<?php

use yii\db\Migration;

/**
 * Class m190322_173501_drop_arrival_column
 */
class m190322_173501_drop_arrival_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('route', 'arrival');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190322_173501_drop_arrival_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190322_173501_drop_arrival_column cannot be reverted.\n";

        return false;
    }
    */
}
