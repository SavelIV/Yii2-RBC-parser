<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m201119_132437_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'picture' => $this->string(255),
            'content' => $this->text(),
            'url' => $this->string(255)->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
