<?php
require_once('../Conn.php');
$pdo = Conn::getInstance();
var_dump(
	$pdo->exec(
		'CREATE TABLE db_updates (id INTEGER PRIMARY KEY AUTO_INCREMENT, version TEXT);'
	), 'create 1.0.0'
);
var_dump(
	$pdo->exec(
		'INSERT into db_updates (version) values ("1.0.0");'
	), 'insert'
);


