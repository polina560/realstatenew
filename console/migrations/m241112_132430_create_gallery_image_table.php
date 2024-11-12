<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gallery_image}}`.
 */
class m241112_132430_create_gallery_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%gallery_image}}', [
            'id' => 'int NOT NULL AUTO_INCREMENT',
            'id_gallery' => $this->integer(),
            'img' => $this->string()->notNull(),
            'title' => $this->string(),
            'text' => $this->text(),
            'PRIMARY KEY(id)'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%gallery_image}}');
    }
}
