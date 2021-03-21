<?php

require_once dirname(__DIR__) . '/config.php';

spl_autoload_register(function ($className) {

    // Enlève le namespace du nom de la classe si celui-ci est spécifié
    $className = explode('\\', $className);
    $pos = count($className) - 1;
    $className = $className[$pos];

    foreach (glob(ROOT_DIRECTORY . '/app/*/*.php') as $fileName) {
        if (pathinfo($fileName, PATHINFO_FILENAME) === $className) {
            require_once $fileName;
        }
    }
});

// Serveur interne de PHP
$url =  $_SERVER['REQUEST_URI'] ?? '';

// Apache
// $url = $_GET['url'] ?? '';

$router = new App\Controller\Router($url);

// Les caractères spéciaux " ? " et " = " doivent être renseignés pour la transmission des variables GET et précédés d'un antislash " \ ".
$router->add('/', 'App\Controller\HomeController:index')
    ->add('/blog', 'App\Controller\PostController:index')
    ->add('/blog/search', 'App\Controller\PostController:search')
    ->add('/blog/search\?q\={query}', 'App\Controller\PostController:search')
    ->add('/blog/search\?q\={query}&p\={page}', 'App\Controller\PostController:search')
    ->add('/blog/{page}', 'App\Controller\PostController:index')
    ->add('/post/{slug}-{id}', 'App\Controller\PostController:show')
    ->add('/admin', 'App\Controller\AdminController:index')
    ->add('/admin/logout', 'App\Controller\AdminController:logout')
    ->add('/admin/post/search\?q\={query}', 'App\Controller\AdminPostController:search')
    ->add('/admin/post/search\?q\={query}&p\={page}', 'App\Controller\AdminPostController:search')
    ->add('/admin/post/new', 'App\Controller\AdminPostController:new')
    ->add('/admin/post/edit/{id}', 'App\Controller\AdminPostController:edit')
    ->add('/admin/post/delete/{id}', 'App\Controller\AdminPostController:delete')
    ->add('/admin/post', 'App\Controller\AdminPostController:post')
    ->add('/admin/post/{page}', 'App\Controller\AdminPostController:post')
    ->add('/contact', 'App\Controller\ContactController:index');

$router->run();
