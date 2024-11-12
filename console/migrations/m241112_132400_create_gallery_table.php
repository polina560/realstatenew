<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gallery}}`.
 */
class m241112_132400_create_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%gallery}}', [
            'id' => 'int NOT NULL AUTO_INCREMENT',
            'name' => $this->string()->notNull(),
            'PRIMARY KEY(id)'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%gallery}}');
    }
}
