<?php

namespace Router;

use App\Exceptions\NotFoundException;

class Routeur
{
	public $url;
	public $routes = array();

	public function __construct($url)
	{
		$this->url = trim($url, '/');
	}

	public function get(string $path, string $action)
	{
		$this->routes['GET'][] = new Route($path, $action);
	}

	public function post(string $path, string $action)
	{
		$this->routes['POST'][] = new Route($path, $action);
	}

	public function run()
	{
		foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {

			if($route->matches($this->url)) {
				// si la condition est vrai donc la fonction execute appel le bon controller et le bonne methodes
				return $route->execute();
			}

		}

		//return header('HTTP/1.0 404 Not Found');
		throw new NotFoundException("La page demandé est introuvable.");
	}
}
