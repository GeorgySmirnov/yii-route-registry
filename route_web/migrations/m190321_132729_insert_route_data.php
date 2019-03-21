<?php

use yii\db\Migration;

/**
 * Class m190321_132729_insert_route_data
 */
class m190321_132729_insert_route_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('route', [
            'origin',
            'departure',
            'destination',
            'arrival',
            'longevity',
            'price',
            'company',
            'schedule',
        ], [
            ['alpha', 12 * 60, 'alpha_d', 13 * 60, 60, 500, 'alpha_c', 'пн, вт, ср'],
            ['beta', 13 * 60, 'beta_d', 13 * 60 + 30, 30, 200, 'beta_c', 'пн, ср'],
            ['gamma', 12 * 60, 'gamma_d', 15 * 60, 180, 800, 'gamma_c', 'сб'],
            ['delta', 12 * 60 + 10, 'delta_d', 12 * 60 + 20, 10, 50, 'delta_c', 'пн, вт, ср, чт, пт, сб, вс'],
            ['epsilon', 12 * 60, 'epsilon_d', 13 * 60, 60, 500, 'epsilon_c', 'пн, ср, пт'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('route');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190321_132729_insert_route_data cannot be reverted.\n";

        return false;
    }
    */
}
