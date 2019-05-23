<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%places}}`.
 */
class m190523_065336_create_places_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%places}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string()->notNull(),
            'lat' => $this->float()->notNull(),
            'lng' => $this->float()->notNull(),
        ]);

        $areas = include __DIR__ . '/areas.php';
        array_walk($areas, function (&$item, $key) {
            $item = [$key, $item['lat'], $item['long']];
        });
        $this->batchInsert('{{%places}}', ['address', 'lat', 'lng'], $areas);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%places}}');
    }
}
