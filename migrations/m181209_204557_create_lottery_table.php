<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lottery`.
 */
class m181209_204557_create_lottery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('lottery', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'points' => $this->integer(),
            'prize' => $this->string(),
            'money' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lottery');
    }
}
