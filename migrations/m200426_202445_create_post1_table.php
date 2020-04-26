<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post1}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user1}}`
 */
class m200426_202445_create_post1_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post1}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'body' => $this->text(),
            'created_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `created_at`
        $this->createIndex(
            '{{%idx-post1-created_at}}',
            '{{%post1}}',
            'created_at'
        );

        // add foreign key for table `{{%user1}}`
        $this->addForeignKey(
            '{{%fk-post1-created_at}}',
            '{{%post1}}',
            'created_at',
            '{{%user1}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user1}}`
        $this->dropForeignKey(
            '{{%fk-post1-created_at}}',
            '{{%post1}}'
        );

        // drops index for column `created_at`
        $this->dropIndex(
            '{{%idx-post1-created_at}}',
            '{{%post1}}'
        );

        $this->dropTable('{{%post1}}');
    }
}
