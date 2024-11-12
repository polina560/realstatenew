<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%document}}`.
 */
class m241112_132348_create_document_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%document}}', [
            'id' => 'int NOT NULL AUTO_INCREMENT',
            'key' => $this->string()->notNull(),
            'file' => $this->string()->notNull(),
            'PRIMARY KEY(id)'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%document}}');
    }
}
