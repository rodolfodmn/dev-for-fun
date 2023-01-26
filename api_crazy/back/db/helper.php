<?php
require_once('Conn.php');

Class DbHelper {

	public static function save($data){
		$pdo = Conn::getInstance();
		$sql = self::formatInsert($data);
		try {
			return $pdo->prepare($sql['sql'])->execute($sql['values']);
		}catch (Exception $e){
			$pdo->rollback();
			throw $e;
		}
	}

	public static function clean($data){
		$pdo = Conn::getInstance();
		$sql = self::formatDelete($data);
		return $pdo->prepare(
			"{$sql}"
		)->execute();
	}

	public static function update($data){
		return null;
	}

	public static function find($data, $all = false){
		$pdo = Conn::getInstance();
		$sql = self::formatSelect($data, $all);
		return $pdo->query(
			"{$sql}"
		)->fetchAll(PDO::FETCH_OBJ);
	}
	
	public static function formatSelect($data, $all = false){
		$from = $data['from'];
		$fields = (isset($data['fields'])) ? $data['fields'] : '*';
		$where = '';
		if(!$all){
			$fieldsWhere = explode(',', $data['where']);
			foreach ($fieldsWhere as $key => $field){
				$ops= explode("-", $field);
				$op = (isset($ops[1]))? $ops[1] : '=';
				$field = $ops[0];
				$fieldsWhere[$key] = str_replace('|', " {$op} ", $field);
			}
			$where = 'WHERE '. implode(',', $fieldsWhere);
		}

		return "SELECT {$fields} FROM {$from} {$where}"; 
	}

	public static function formatDelete($data){
		unset($data['action']);
		$from = $data['from'];
		$where = '';
		$fieldsWhere = explode(',', $data['where']);
		foreach ($fieldsWhere as $key => $field){
			$ops= explode("-", $field);
			$op = (isset($ops[1]))? $ops[1] : '=';
			$field = $ops[0];
			$fieldsWhere[$key] = str_replace('|', " {$op} ", $field);
			$where = 'WHERE '. implode(',', $fieldsWhere);
		}

		return "DELETE FROM {$from} {$where}"; 
	}
	public static function formatInsert($data){
		unset($data['action']);
		$entity = $data['from'];
		unset($data['from']);
		if(isset($data['where'])){
			return self::formatUpdate($data, $entity);
		}
		
		$fields = implode(', ', array_keys($data));
		$sets = [];
		foreach (array_values($data) as $val){
			$sets[] = '?';
		}
		$values = array_values($data);
		$sets = implode(', ', $sets);
		return [
			'sql' => "INSERT into {$entity} ({$fields}) VALUES ({$sets})",
			'values' => $values
		];
	}
	
	public static function formatUpdate($data, $entity){
		$fields = explode(',', $data['where']);
		foreach ($fields as $key => $field){
			$fields[$key] = str_replace('|', '=', $field);
		}
		$where = 'WHERE '. implode(',', $fields);
		unset($data['where']);
		$fields = '';
		foreach($data as $field => $field){
			$fields .= "{$field}=?, ";
		}
		$fields = substr($fields, 0, (strlen($fields)-2));
		return [
			'sql' => "UPDATE {$entity} SET {$fields} {$where}",
			'values' => array_values($data)
		];
	}
}
