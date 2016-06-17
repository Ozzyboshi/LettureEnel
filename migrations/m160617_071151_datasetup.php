<?php

use yii\db\Migration;
use yii\base\InvalidConfigException;
use yii\rbac\DbManager;
use yii\db\Schema;

class m160617_071151_datasetup extends Migration
{
    protected function getAuthManager()
    {
      $authManager = Yii::$app->getAuthManager();
      if (!$authManager instanceof DbManager) {
          throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
      }
      return $authManager;
    }
    public function up()
    {

	$authManager = $this->getAuthManager();

	$this->insert($authManager->itemTable,array(
	 'name'=>'/*',
	 'type'=>2,
	 'description'=>NULL,
	 'rule_name'=>NULL,
	 'data'=>NULL,
	 'created_at'=>time(),
	 'updated_at'=>time(),
	));

	$this->insert($authManager->itemTable,array(
	 'name'=>'/admin/*',
	 'type'=>2,
	 'description'=>NULL,
	 'rule_name'=>NULL,
	 'data'=>NULL,
	 'created_at'=>time(),
	 'updated_at'=>time(),
	));

	$this->insert($authManager->itemTable,array(
         'name'=>'permission_admin',
         'type'=>2,
         'description'=>'tutto',
         'rule_name'=>NULL,
         'data'=>NULL,
         'created_at'=>time(),
         'updated_at'=>time(),
        ));

	$this->insert($authManager->itemTable,array(
         'name'=>'sysadmin',
         'type'=>1,
         'description'=>'tutto',
         'rule_name'=>NULL,
         'data'=>NULL,
         'created_at'=>time(),
         'updated_at'=>time(),
        ));

	$this->insert($authManager->itemTable,array(
         'name'=>'user',
         'type'=>1,
         'description'=>'cacca',
         'rule_name'=>NULL,
         'data'=>NULL,
         'created_at'=>time(),
         'updated_at'=>time(),
        ));

	$this->insert('auth_item_child',array(
	 'parent'=>'sysadmin',
	 'child'=>'/*',
	));

	$this->insert('auth_item_child',array(
         'parent'=>'sysadmin',
         'child'=>'/admin/*',
        ));

	$this->insert('auth_item_child',array(
         'parent'=>'sysadmin',
         'child'=>'permission_admin',
        ));

	$this->insert('auth_assignment',array(
         'item_name'=>'sysadmin',
         'user_id' =>'1',
         'created_at' => time(),
        ));

	$this->insert('user',array(
	 'id'=>1,
         'username'=>'admin',
         'auth_key'=>'QahrGMtvmMHecFeO0RdF2lITCNFyFGS5',
         'displayname'=>'',
	 'password_hash'=>'$2y$13$h4UJZhbLu8ZKCezkWznIDetsp1DBommupiW7TsW/2PIa7.OQkMB7y',
	 'email'=>'admin@example.com',
	 'role'=>'10',
	 'status'=>'10',
	 'created_at'=>time(),
	 'updated_at'=>time(),
        ));
    }

    public function down()
    {
	$this->delete('auth_item');
	$this->delete('auth_item_child');
	$this->delete('auth_assignment');
	$this->delete('user');
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
