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
            $this->post();
        } else {
            $this->login();
        }
    }

    public function login()
    {
        if (isset($_SESSION['admin'])) {
            return $this->post();
        }

        $error = null;

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            if ($_POST['username'] === ADMIN_USERNAME && $_POST['password'] === ADMIN_PASSWORD) {
                $_SESSION['admin'] = true;
                return $this->post();
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

    /**
     * @param array $params
     */
    public function post(array $params = [])
    {
        if (!isset($_SESSION['admin'])) {
            return $this->login();
        }

        $currentPage = $params[1] ?? 1;
        $currentPage = (int) $currentPage;

        $limit = 10;
        $offset = 0;
        if ($currentPage > 1) {
            $offset = ($currentPage - 1) * 10;
        }
        $count = (int) $this->postManager->count([]);
        $requiredPages = ceil($count / $limit);

        $postList = $this->postManager->read([], $limit, $offset);

        $this->render('/admin/post/index.php', [
            'currentPage' => $currentPage,
            'requiredPages' => $requiredPages,
            'postList' => $postList
        ]);
    }
}
