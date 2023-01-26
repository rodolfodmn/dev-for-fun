<?php
include('../db/helper.php');
header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: Content-Type');
$post = json_decode(file_get_contents('php://input'), true);
if(!$post)
	$post = $_GET;

function handler($post){
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
		case 'find':
			$resp = find($post);
			break;
		case 'findAll':
			$resp = findAll($post);
			break;
		default:
			$resp = json_encode(['error'=>'action não encontrada']);
 	}
	echo json_encode(['msg'=>$resp]);
}

handler($post);

function create($post){
	return DbHelper::save($post);
}

function clean($post){
	return DbHelper::clean($post);
}

function update($post){
	return DbHelper::save($post);
}

function find($post){
	return DbHelper::find($post);
}

function findAll($post){
	return DbHelper::find($post, true);
}
