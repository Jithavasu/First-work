<?php 
use Doctrine\DBAL\DriverManager;

require __DIR__.'/../vendor/autoload.php';

$paths = array("/path/to/entity-files");

$isDevMode = false;

// the connection configuration
$dbParams = array(
'driver'   => 'pdo_mysql',
'user'     => 'root',
'password' => 'jitha',
'dbname'   => 'task',
);  
$conn= DriverManager::getConnection($dbParams); 
