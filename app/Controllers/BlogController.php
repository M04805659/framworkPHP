<?php
namespace App\Controllers;

use App\Models\Post;
use App\Models\Tag;

class BlogController extends Controller {

	public function index()
	{
		$posts     = (new Post($this->getDB()))->all();

		return $this->view('blog.index', compact('posts'));
	}

	public function welcome()
	{
		return $this->view('blog.welcome');
	}

	public function show(int $id)
	{
		$post = (new Post($this->getDB()))->findByid($id);

		return $this->view('blog.show', compact('post'));
	}

	public function tag(int $id)
	{
		$tag = (new Tag($this->getDB()))->findByid($id);

		return $this->view('blog.tag', compact('tag'));
	}
}