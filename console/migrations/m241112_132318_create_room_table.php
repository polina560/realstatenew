<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room}}`.
 */
class m241112_132318_create_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%room}}', [
            'id' => 'int NOT NULL AUTO_INCREMENT',
            'id_apartment' => $this->integer()->notNull(),
            'title' => $this->string(),
            'area' => $this->integer(),
            'uid' =>  $this->string(),
            'PRIMARY KEY(id)'

        ]);
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%room}}');
    }
}
