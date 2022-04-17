<?php

namespace App\Models;

use Database\DBConnection;
use PDO;

abstract class Model {

	protected $db;
	protected $table;

	public function __construct(DBConnection $db)
	{
		$this->db = $db;
	}

	public function all(): array
	{
		return $this->query("select * from {$this->table} order by created_at DESC");
	}

	public function findByid(int $id): Model
	{
		return $this->query("select * from {$this->table} where id = ? ", [$id], true );
	}

	public function query(string $sql, array $param = null, bool $single = null)
	{
		$method    = is_null($param) ? 'query' : 'prepare';

		if(strpos($sql, 'delete') === 0 || strpos($sql, 'update') === 0 || strpos($sql, 'insert') === 0) {
			$statement = $this->db->getPDO()->$method($sql);
			$statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
			return $statement->execute($param);
		}
		$fetch     = is_null($single) ? 'fetchAll' : 'fetch';
		$statement = $this->db->getPDO()->$method($sql);
		$statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

		if($method === 'query') {
			return $statement->$fetch();
		} else {
			$statement->execute($param);
			return $statement->$fetch();
		}
	}

	public function destroy($id): bool
	{
		return $this->query("delete from {$this->table} where id = ?", [$id]);
	}

	public function update($id, array $data, array $relation = null): bool
	{
		$sqlRequestPart = "";
		$i              = 1;
		foreach ($data as $key => $value)
		{
			$comma = $i === count($data) ? ' ' : ', ';
			$sqlRequestPart .= "{$key} = :{$key}". $comma;
			$i++;
		}
		$data['id'] = $id;

		return $this->query("update {$this->table} set {$sqlRequestPart} where id = :id", $data);
	}

	public function create(array $data, array $relation = null): bool
	{
		"insert into posts (title, content) values (:title, :content)";
		$firstParam  = "";
		$secondParam = "";

		$i              = 1;
		foreach ($data as $key => $value)
		{
			$comma = $i === count($data) ? '' : ', ';
			$firstParam .= $key.$comma;
			$secondParam .= ':'.$key.$comma;
			$i++;
		}

		return $this->query("insert into  {$this->table} ($firstParam) values ($secondParam)", $data);
	}

}