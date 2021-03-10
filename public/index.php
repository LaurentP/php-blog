<?php

require_once dirname(__DIR__) . '/config.php';

spl_autoload_register(function ($className) {

    // Enlève le namespace du nom de la classe si celui-ci est spécifié
    $className = explode('\\', $className);
    $pos = count($className) - 1;
    $className = $className[$pos];

    foreach (glob(dirname(__DIR__) . '/app/*/*.php') as $fileName) {
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

$router->add('/', 'App\Controller\HomeController:index')
    ->add('/blog', 'App\Controller\PostController:index')
    ->add('/post/{slug}-{id}', 'App\Controller\PostController:show')
    ->add('/admin', 'App\Controller\AdminController:index')
    ->add('/admin/logout', 'App\Controller\AdminController:logout')
    ->add('/admin/post/new', 'App\Controller\PostController:new')
    ->add('/admin/post/edit/{id}', 'App\Controller\PostController:edit')
    ->add('/admin/post/delete/{id}', 'App\Controller\PostController:delete')
    ->add('/admin/{page}', 'App\Controller\AdminController:post')
    ->add('/contact', 'App\Controller\ContactController:index')
    ->add('/{page}', 'App\Controller\PostController:index');

$router->run();
