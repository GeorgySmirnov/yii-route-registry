<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190321_130555_create_route_table
 */
class m190321_130555_create_route_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('route', [
            'id' => $this->primaryKey(),
            'origin' => $this->string(),
            'departure' => $this->integer(),
            'destination' => $this->string(),
            'arrival' => $this->integer(),
            'longevity' => $this->integer(),
            'price' => $this->integer(),
            'company' => $this->string(),
            'schedule' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('route');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        return false;
    }
    */
}
