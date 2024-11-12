<?php

use yii\db\Migration;

/**
 * Class m241112_132847_add_column_to_text
 */
class m241112_132847_add_column_to_text extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%text}}', 'group', $this->string());
        $this->addColumn('{{%text}}', 'deletable', $this->boolean()->notNull()->defaultValue(0));
        $this->addColumn('{{%text}}', 'comment', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%text}}', 'group');
        $this->dropColumn('{{%text}}', 'deletable');
        $this->dropColumn('{{%text}}', 'comment');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241112_132847_add_column_to_text cannot be reverted.\n";

        return false;
    }
    */
}
