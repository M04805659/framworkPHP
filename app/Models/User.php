<?php
namespace App\Models;

class User extends Model {

		protected $table = 'users';

		public function getByUsername(string $username): User
		{
			return $this->query("select * from {$this->table} where username = ?", [$username], true);
		}
}