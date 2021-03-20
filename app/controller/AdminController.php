<?php

namespace App\Controller;

use App\Model\PostManager;

class AdminController extends Controller
{
    /**
     * @var PostManager
     */
    private $postManager;

    public function __construct()
    {
        parent::__construct();
        $this->postManager = new PostManager($this->dbh);
    }

    public function index()
    {
        if (isset($_SESSION['admin'])) {
            return header('Location:/admin/post');
        } else {
            $this->login();
        }
    }

    public function login()
    {
        if (isset($_SESSION['admin'])) {
            return header('Location:/admin/post');
        }

        $error = null;

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            if ($_POST['username'] === ADMIN_USERNAME && $_POST['password'] === ADMIN_PASSWORD) {
                $_SESSION['admin'] = true;
                return header('Location:/admin/post');
            } else {
                $error = 'Incorrect login or password.';
            }
        }

        $this->render('/admin/login.php', [
            'error' => $error
        ]);
    }

    public function logout()
    {
        unset($_SESSION['admin']);
        session_destroy();
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
}
