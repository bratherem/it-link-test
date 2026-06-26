<?php

use yii\db\Migration;

class m260626_000001_create_car_tables extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%car}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'price' => $this->decimal(12, 2)->notNull(),
            'photo_url' => $this->string()->notNull(),
            'contacts' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('{{%car_option}}', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer()->notNull(),
            'brand' => $this->string()->notNull(),
            'model' => $this->string()->notNull(),
            'year' => $this->integer()->notNull(),
            'body' => $this->string()->notNull(),
            'mileage' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-car_option-car_id',
            '{{%car_option}}',
            'car_id',
            '{{%car}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex('idx-car_option-car_id', '{{%car_option}}', 'car_id', true);
    }

    public function safeDown(): void
    {
        $this->dropForeignKey('fk-car_option-car_id', '{{%car_option}}');
        $this->dropTable('{{%car_option}}');
        $this->dropTable('{{%car}}');
    }
}
