<?php

namespace App\Controller;

class ErrorController extends Controller
{
    public function index()
    {
        $this->render('/error404.php', []);
    }
}