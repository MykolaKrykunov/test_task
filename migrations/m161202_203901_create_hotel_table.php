<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hotel`.
 * Has foreign keys to the tables:
 *
 * - `city`
 */
class m161202_203901_create_hotel_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('hotel', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'city_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `city_id`
        $this->createIndex(
            'idx-hotel-city_id',
            'hotel',
            'city_id'
        );

        // add foreign key for table `city`
        $this->addForeignKey(
            'fk-hotel-city_id',
            'hotel',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `city`
        $this->dropForeignKey(
            'fk-hotel-city_id',
            'hotel'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            'idx-hotel-city_id',
            'hotel'
        );

        $this->dropTable('hotel');
    }
}
