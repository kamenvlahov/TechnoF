<?php

return array(
				'db' => array(
				'driver'         => 'Pdo',
				'username'=>"root",
				//'password'=>"kamen54321",
				'dsn'            => 'mysql:dbname=technofarm;host=localhost;',
				'driver_options' =>  array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8;'),
		),
		'service_manager' => array(
				'factories' => array(
						'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
				),
		),
);