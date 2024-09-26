<?php

use yii\db\Migration;

/**
 * Class m240905_151329_user
 */
class m240905_151329_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    } 

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user'); 
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240905_151329_user cannot be reverted.\n";

        return false;
    }
    */
}
