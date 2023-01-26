<?php
include('db/helper.php');
header('Access-Control-Allow-Origin: *');  
$post = $_REQUEST;

function handler($post){
	$params = json_encode($post);
	$resp = '';
	switch ($post['action']){
		case 'create':
			$resp = create($post);
			break;
		case 'clean':
			$resp = clean($post);
			break;
		case 'update':
			$resp = update($post);
			break;
		case 'updateStock':
			$resp = updateStock($post);
			break;
		case 'find':
			$resp = find($post);
			break;
		case 'findAll':
			$resp = findAll($post);
			break;
		default:
			$resp = json_encode(['error'=>'action não encontrada']);
 	}
	echo json_encode($resp);
}

handler($post);

function create($post){
	DbHelper::save($post);
}

function clean(){
	return 'clea';
}

function update($post){
	return DbHelper::save($post);
}

function updateStock($post){
	return DbHelper::update($post);
}

function find($post){
	return DbHelper::find($post);
}

function findAll($post){
	return DbHelper::find($post, true);
}
