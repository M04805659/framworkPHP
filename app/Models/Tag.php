<?php

namespace App\Models;

class Tag extends Model {

	protected $table = 'tags';

	public function getPosts()
	{
		return $this->query("select p.* from Posts p 
		inner join  post_tag pt ON pt.id_post = p.id
		where pt.id_tag = ?
	  ", [$this->id]);
	}
}
