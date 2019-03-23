<?php

use yii\db\Migration;
use yii\db\Query;
use app\models\Route;

/**
 * Class m190322_200506_convert_schedule_column
 */
class m190322_200506_convert_schedule_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('route', 'new_schedule', $this->integer());
        foreach ((new Query)->from('route')->each() as $route)
        {
            $this->update('route', ['new_schedule' => Route::scheduleStrToInt($route['schedule'])], ['id' => $route['id']]);
        }
        $this->dropColumn('route', 'schedule');
        $this->renameColumn('route', 'new_schedule', 'schedule');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190322_200506_convert_schedule_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190322_200506_convert_schedule_column cannot be reverted.\n";

        return false;
    }
    */
}
