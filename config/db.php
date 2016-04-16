<?php

require('../vendor/pear/net_dns2/Net/DNS2.php');

function get_db()
{
	$r = new Net_DNS2_Resolver(array('nameservers' => array('104.233.78.98','168.235.155.197','167.88.44.177')));
	$result=$r->query('mysqlfotovoltaico.service.consul.','A');
	foreach($result->answer as $rr)
	{
		$resolver = new Net_DNS2_Resolver();
		$response = $resolver->query($rr->cname,"A");
		foreach ($response->answer as $rrr)
		{
			$connstring='mysql:host='.$rrr->address.';dbname=fotovoltaico';
		}
		return $connstring;
	}
}

return [
    'class' => 'yii\db\Connection',
    //'dsn' => getenv('DB_STRING'),
    'dsn' => get_db(),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
    'charset' => 'utf8',
];
