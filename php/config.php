<?php
include_once('Database.php');
define('SS_DB_NAME', 'simuel');
define('SS_DB_USER', 'sevin');
define('SS_DB_PASSWORD', '@sevin2021!');
define('SS_DB_HOST', 'localhost');
//$conexao = new PDO("mysql:host=localhost; dbname=crudsimples", "sevin", "@sevin2021!");
$dsn	= 	"mysql:dbname=".SS_DB_NAME.";host=".SS_DB_HOST."";
$pdo	=	"";
try {
	$pdo = new PDO($dsn, SS_DB_USER, SS_DB_PASSWORD);
	//echo "Connection OK: " ;
}catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
$db 	=	new Database($pdo);
?>