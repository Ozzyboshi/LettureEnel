<?php

use yii\db\Schema;
use yii\db\Migration;

class m160104_204951_create_fotovoltaico_tables extends Migration
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
        'datainiziovalidita' => 'date' . ' NOT NULL default \'0000-00-00\'',
        'datafinevalidita' => 'date' . ' NOT NULL default \'0000-00-00\'',
        'prezzofascia1' => 'double' . '(8,6) NOT NULL default \'0.00\'',
        'prezzofascia2' => 'double' . '(8,6) NOT NULL default \'0.00\'',
        'prezzofascia3' => 'double' . '(8,6) NOT NULL default \'0.00\'',
    ], $tableOptions);

    $this->createTable('{{%letture}}', [
        'id' => Schema::TYPE_PK,
        'data' => 'date' . ' NOT NULL default \'0000-00-00\'',
        'consumofascia1' => Schema::TYPE_INTEGER . ' NOT NULL default 0',
        'consumofascia2' => Schema::TYPE_INTEGER . ' NOT NULL default 0',
        'consumofascia3' => Schema::TYPE_INTEGER . ' NOT NULL default 0',
        'produzionefascia1' => Schema::TYPE_INTEGER . ' NOT NULL default 0',
        'produzionefascia2' => Schema::TYPE_INTEGER . ' NOT NULL default 0',
        'produzionefascia3' => Schema::TYPE_INTEGER . ' NOT NULL default 0',
        'immissionefascia1' => Schema::TYPE_INTEGER . ' NOT NULL default 0',
        'immissionefascia2' => Schema::TYPE_INTEGER . ' NOT NULL default 0',
        'immissionefascia3' => Schema::TYPE_INTEGER . ' NOT NULL default 0',
    ], $tableOptions);

  }

  public function safeDown()
  {
      $this->dropTable('{{%prezzi}}');
      $this->dropTable('{{%letture}}');
      return false;
  }
}
