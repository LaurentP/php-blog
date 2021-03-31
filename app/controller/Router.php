<?php

namespace App\Controller;

/**
 * Routeur fait pour fonctionner avec l'url rewriting
 */
class Router
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var string
     */
    private $errorAction;

    /**
     * @param string $url Contient la portion d'url entrée par le navigateur qui suit l'adresse du site
     */
    public function __construct(string $url)
    {
        $this->url = trim($url, '/');
    }

    /**
     * Ajoute une route et l'action souhaitée à la liste des routes
     * 
     * @param string $url
     * @param string $action
     * @return self
     */
    public function add(string $url, string $action): self
    {
        $url = trim($url, '/');
        $this->routes[$url] = $action;
        return $this;
    }

    /**
     * Ajoute l'action à exécuter en cas d'erreur 404 si l'on souhaite la personnaliser, cela n'est pas obligatoire
     * 
     * @param string $action
     * @return self
     */
    public function onError(string $action): self
    {
        $this->errorAction = $action;
        return $this;
    }

    /**
     * Cherche la route correspondante à l'url et redirige vers la méthode correspondante si celle-ci est trouvée
     */
    public function run()
    {
        foreach ($this->routes as $route => $action) {
            if ($this->match($route, $this->url)) {
                return $this->execute($action);
            }
        }
        header('HTTP/1.0 404 Not Found');
        if (!empty($this->errorAction)) {
            return $this->execute($this->errorAction);
        }
    }

    /**
     * Vérifie si l'url entrée par le visiteur correspond à la route donnée
     * Si l'url contient des paramètres ceux-ci sont enregistrés afin d'être réutilisés
     * Si contact correspond à contact/, ou si user/{id} correspond à user/123, true sera retourné
     * 
     * @param string $route
     * @param string $url
     * @return bool
     */
    private function match(string $route, string $url): bool
    {
        $pattern = preg_replace('#({[a-z]+})#', '([\w-]+)', $route);
        if (!preg_match("#^$pattern$#", $url, $matches)) {
            return false;
        }
        $this->params[] = $matches;
        return true;
    }

    /**
     * Exécute l'action souhaitée qui a été donnée en second paramètre de la méthode add()
     * 
     * @param string $action
     * @return void
     */
    private function execute(string $action): void
    {
        $action     = explode(':', $action);
        $controller = new $action[0]();
        $method     = $action[1];
        call_user_func_array([$controller, $method], $this->params);
    }
}