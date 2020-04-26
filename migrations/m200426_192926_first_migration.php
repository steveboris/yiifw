<?php

use yii\db\Migration;

/**
 * Class m200426_192926_first_migration
 */
class m200426_192926_first_migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // write the code to apply to the DB
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'status' => $this->boolean(),
            'created_at' => $this->integer()
        ]);
        // add a column
        $this->addColumn('{{%user}}', 'email', $this->string(512)->notNull());

        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'user_id' => $this->integer()
        ]);
        $this->addForeignKey('FK_post_user', 'post', 'user_id', 'user', 'id');

        // Insert dummy data
        $this->insert('user', [
            'username' => 'Jean',
            'email' => 'jean@example.com',
            'status' => 1,
            'created_at' => time()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Write the opposite of what are in safeUp
        $this->dropForeignKey('FK_post_user', 'post');
        $this->dropTable('post');
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200426_192926_first_migration cannot be reverted.\n";

        return false;
    }
    */
}
