<?php
include('./Conn.php');
$pdo = Conn::getInstance();

$pdo->exec(
	 'CREATE TABLE clientes (id INTEGER PRIMARY KEY AUTO_INCREMENT, name TEXT, cpf TEXT, cep TEXT, number TEXT, neighborhood TEXT, complement TEXT, street TEXT, create_at TEXT, updated_at TEXT);'
);

$pdo->exec(
	 'CREATE TABLE produtos (id INTEGER PRIMARY KEY AUTO_INCREMENT, value TEXT, qty INTEGER,  name TEXT, description TEXT, recipe TEXT, img TEXT, create_at TEXT, updated_at TEXT);'
);

$pdo->exec(
	 'CREATE TABLE pedidos (id INTEGER PRIMARY KEY AUTO_INCREMENT, obs TEXT, cliente_name TEXT, cliente_id TEXT, prod_qty TEXT, total TEXT, create_at TEXT, updated_at TEXT);'
);

$pdo->exec(
	 'CREATE TABLE saidas (id INTEGER PRIMARY KEY AUTO_INCREMENT, description TEXT, value TEXT, create_at TEXT, updated_at TEXT);'
);
