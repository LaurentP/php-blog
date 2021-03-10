<?php

namespace App\Controller;

use App\Model\PostManager;

class HomeController extends Controller
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
        $latestPosts = $this->postManager->read(['enabled' => '1'], 4, 0);

        $this->render('/home/index.php', [
            'latestPosts' => $latestPosts
        ]);
    }
}