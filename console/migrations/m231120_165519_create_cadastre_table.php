<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cadastre}}`.
 */
class m231120_165519_create_cadastre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cadastre}}', [
            'id'              => $this->primaryKey(),
            'cadastralNumber' => $this->string(64)->notNull()->unique(),
            'address'         => $this->string(512)->notNull(),
            'price'           => $this->decimal(10, 4)->notNull(),
            'area'            => $this->decimal(10,4)->notNull(),
            'last_update'     => $this->dateTime()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cadastre}}');
    }
}
