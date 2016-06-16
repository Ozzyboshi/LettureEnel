<?php

use yii\db\Schema;
use yii\db\Migration;

class m160104_200434_create_fotovoltaico_tables extends Migration
{
    public function safeUp()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }
      $this->createTable('{{%prezzi}}', [
          'id' => Schema::TYPE_PK,
          'datainiziovalidita' => 'date' . ' NOT NULL',
          'datafinevalidita' => 'date' . ' NOT NULL',
          'prezzofascia1' => 'double' . '(8,6) NOT NULL default \'0.00\'',
          'prezzofascia2' => 'double' . '(8,6) NOT NULL default \'0.00\'',
          'prezzofascia3' => 'double' . '(8,6) NOT NULL default \'0.00\'',
      ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%prezzi}}');

        return false;
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
