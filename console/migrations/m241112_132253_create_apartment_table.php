<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apartment}}`.
 */
class m241112_132253_create_apartment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%apartment}}', [
            'id' => 'int NOT NULL AUTO_INCREMENT',
            'title' => $this->string()->notNull(),
            'subtitle' => $this->string(),
            'description' => $this->string(),
            'price' => $this->integer()->notNull(),
            'floor' => $this->integer()->notNull(),
            'img' => $this->string(),
            'address' => $this->string(),
            'add_title' => $this->string(),
            'add_img' =>$this->string(),
            'API_flag' => $this->boolean(),
            'PRIMARY KEY(id)'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%apartment}}');
    }
}
