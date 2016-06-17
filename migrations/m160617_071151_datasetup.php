<?php

use yii\db\Migration;

class m160617_071151_datasetup extends Migration
{
    public function up()
    {
	$this->insert('auth_item',array(
	 'name'=>'/*',
	 'type'=>2,
	 'description'=>NULL,
	 'rule_name'=>NULL,
	 'data'=>NULL,
	 'created_at'=>time(),
	 'updated_at'=>time(),
	));

	$this->insert('auth_item',array(
	 'name'=>'/admin/*',
	 'type'=>2,
	 'description'=>NULL,
	 'rule_name'=>NULL,
	 'data'=>NULL,
	 'created_at'=>time(),
	 'updated_at'=>time(),
	));

	$this->insert('auth_item',array(
         'name'=>'permission_admin',
         'type'=>2,
         'description'=>'tutto',
         'rule_name'=>NULL,
         'data'=>NULL,
         'created_at'=>time(),
         'updated_at'=>time(),
        ));

	$this->insert('auth_item',array(
         'name'=>'sysadmin',
         'type'=>1,
         'description'=>'tutto',
         'rule_name'=>NULL,
         'data'=>NULL,
         'created_at'=>time(),
         'updated_at'=>time(),
        ));

	$this->insert('auth_item',array(
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
