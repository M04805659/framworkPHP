<?php

namespace App\Models;

class Post extends Model {

	protected $table = 'posts';

	public function getCreatedAt(): string
	{
		return (new \DateTime($this->created_at))->format('d/m/Y à H:i');
	}

	public function getExcerpt(): string
	{
		return substr($this->content, 0, 200). '....';
	}

	public function getButton(): string
	{
		return <<<HTML
			<a href="/posts/$this->id" class="btn btn-primary">Lire plus </a>
HTML;
	}

	public function getTags()
	{
	 return $this->query("select t.* from tags t 
		inner join  post_tag pt ON pt.id_tag = t.id
		inner join posts p ON pt.id_post = p.id
		where p.id = ?
	  ", [$this->id]);
	}

	public function update($id, array $data, array $relation = null): bool
	{
		parent::update($id, $data);
		$statement = $this->db->getPDO()->prepare("delete from post_tag where id_post = ? ");
		$result = $statement->execute([$id]);

		foreach ($relation as $tagId) {
			$stmt  = $this->db->getPDO()->prepare("insert into post_tag (id_post, id_tag) values (?,?)");
			$stmt->execute([$id, $tagId]);
		}

		if($result) {
			return true;
		}
	}

	public function create(array $data, array $relation = null): bool
	{
		parent::create($data);
		$id = $this->db->getPDO()->lastInsertId();

		foreach ($relation as $tagId) {
			$stmt  = $this->db->getPDO()->prepare("insert into post_tag (id_post, id_tag) values (?,?)");
			$stmt->execute([$id, $tagId]);
		}

			return true;
	}
}
