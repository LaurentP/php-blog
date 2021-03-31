<?php

namespace App\Controller;

use App\Model\PostManager;

class PostController extends Controller
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

    /**
     * @param array $params
     */
    public function index(array $params)
    {
        $currentPage = $params[1] ?? 1;
        $currentPage = (int) $currentPage;

        $limit = 10;
        $offset = 0;

        if ($currentPage > 1) $offset = ($currentPage - 1) * 10;
        
        $count = (int) $this->postManager->count(['enabled' => '1']);
        $requiredPages = ceil($count / $limit);

        $postList = $this->postManager->read(['enabled' => '1'], $limit, $offset);

        $this->render('/post/index.php', [
            'currentPage' => $currentPage,
            'requiredPages' => $requiredPages,
            'postList' => $postList
        ]);
    }

    public function search()
    {
        if (empty($_GET['q'])) return header('Location:/blog');

        $query = trim($_GET['q']);

        $currentPage = $_GET['p'] ?? 1;
        $currentPage = (int) $currentPage;

        $limit = 10;
        $offset = 0;

        if ($currentPage > 1) $offset = ($currentPage - 1) * 10;
        
        $count = (int) $this->postManager->searchCount(['enabled' => '1'], $query);
        $requiredPages = ceil($count / $limit);

        $postList = $this->postManager->search(['enabled' => '1'], $query, $limit, $offset);

        $this->render('/post/search.php', [
            'query' => $query,
            'currentPage' => $currentPage,
            'requiredPages' => $requiredPages,
            'count' => $count,
            'postList' => $postList
        ]);
    }

    /**
     * @param array $params
     */
    public function show(array $params)
    {
        $slug = $params[1];
        $id = (int) $params[2];

        $posts = $this->postManager->read(['id' => $id, 'slug' => $slug, 'enabled' => 1], 0, 0);

        if (!$posts) {
            header('HTTP/1.0 404 Not Found');
            return $this->render('/error404.php', []);
        }

        $this->render('/post/show.php', [
            'post' => $posts[0]
        ]);
    }
}
