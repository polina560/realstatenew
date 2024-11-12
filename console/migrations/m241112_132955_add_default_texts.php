<?php

use yii\db\Migration;

/**
 * Class m241112_132955_add_default_texts
 */
class m241112_132955_add_default_texts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%text}}', ['group', 'key', 'value', 'comment'], [
            ['contacts', 'main_address', 'text1', ''],
            ['contacts', 'main_phone', 'text2', ''],
            ['contacts', 'sales_office_address', 'text3', ''],
            ['contacts', 'sales_office_phone', 'text4', '']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%text}}', ['group' => 'contacts']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241112_132955_add_default_texts cannot be reverted.\n";

        return false;
    }
    */
}
