<?php

use yii\db\Schema;
use yii\db\Migration;

class m160625_201752_bonificigsetable extends Migration
{
    public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }
      $this->createTable('bonificigse3', [
          'id' => Schema::TYPE_PK,
	        'data' => 'date' . ' NOT NULL',
          'causale' => Schema::TYPE_STRING . '(255) NOT NULL default \'\'',
          'importo' => Schema::TYPE_DOUBLE . '(5,2) NOT NULL default \'0.00\'',
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('bonificigse3');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
