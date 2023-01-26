<?php
require_once('../Conn.php');
$pdo = Conn::getInstance();
var_dump(
	$pdo->exec(
		'ALTER TABLE pedidos ADD status TEXT'
	), 'alter pedidos add status 1.0.1'
);
var_dump(
	$pdo->exec(
		"UPDATE pedidos SET status = '2'"
	), 'update pedidos'
);
var_dump(
	$pdo->exec(
		'INSERT into db_updates (version) values ("1.0.1")'
	), 'insert'
);


