<?php

namespace App\Controller;

use App\Model\PostManager;
use App\Helpers\TextToSlug;
use App\Helpers\ImageHandler;

class AdminPostController extends Controller
{
    /**
     * @var PostManager
     */
    private $postManager;

    /**
     * @var string
     */
    private $uploadDir;

    public function __construct()
    {
        parent::__construct();
        $this->postManager = new PostManager($this->dbh);
        $this->uploadDir = ROOT_DIRECTORY . '/public/upload/post/';
    }

    /**
     * @param array $params
     */
    public function post(array $params = [])
    {
        if (!isset($_SESSION['admin'])) return header('Location:/admin');

        $currentPage = $params[1] ?? 1;
        $currentPage = (int) $currentPage;

        $limit = 10;
        $offset = 0;

        if ($currentPage > 1) $offset = ($currentPage - 1) * 10;

        $count = (int) $this->postManager->count([]);
        $requiredPages = ceil($count / $limit);

        $postList = $this->postManager->read([], $limit, $offset);

        $this->render('/admin/post/index.php', [
            'currentPage' => $currentPage,
            'requiredPages' => $requiredPages,
            'postList' => $postList
        ]);
    }

    public function search()
    {
        if (!isset($_SESSION['admin'])) return header('Location:/admin');

        if (empty($_GET['q'])) return header('Location:/blog');

        $query = trim($_GET['q']);

        $currentPage = $_GET['p'] ?? 1;
        $currentPage = (int) $currentPage;

        $limit = 10;
        $offset = 0;

        if ($currentPage > 1) $offset = ($currentPage - 1) * 10;

        $count = (int) $this->postManager->searchCount([], $query);
        $requiredPages = ceil($count / $limit);

        $postList = $this->postManager->search([], $query, $limit, $offset);

        $this->render('/admin/post/search.php', [
            'query' => $query,
            'currentPage' => $currentPage,
            'requiredPages' => $requiredPages,
            'count' => $count,
            'postList' => $postList
        ]);
    }

    public function new()
    {
        if (!isset($_SESSION['admin'])) return header('Location:/admin');

        $error = null;

        if (!empty($_POST['title']) && isset($_FILES['image']) && !empty($_POST['content']) && !empty($_POST['csrf_token'])) {

            if (isset($_SESSION['admin']['csrf_token']) && ($_SESSION['admin']['csrf_token'] !== $_POST['csrf_token'])) {
                $error = 'Failed access attempt.';
            }

            if ($error === null) {

                $imageResult = ImageHandler::upload($_FILES['image'], $this->uploadDir);

                // $result['error'] retourne une cha??ne de caract??res vide s'il n'y a pas d'image envoy??e ou si l'image envoy??e est valide.
                if ($imageResult['error'] === '') {

                    ImageHandler::createThumb($imageResult['file_name'], $this->uploadDir);

                    $newTitle = htmlspecialchars($_POST['title']);
                    $newSlug = TextToSlug::convert($newTitle);
                    $enabled = (int) isset($_POST['enabled']);
                    $data = [
                        'title' => $newTitle,
                        'slug' => $newSlug,
                        'image' => $imageResult['file_name'],
                        'content' => htmlspecialchars($_POST['content']),
                        'created_at' => date('Y-m-d H:i:s'),
                        'enabled' => $enabled
                    ];

                    $this->postManager->create($data);
                    header('Location:/admin');
                } else {
                    $error = $imageResult['error'];
                }
            }
        }

        $this->render('/admin/post/new.php', [
            'error' => $error,
            'csrf_token' => $_SESSION['admin']['csrf_token']
        ]);
    }

    /**
     * @param array $params
     */
    public function preview(array $params)
    {
        if (!isset($_SESSION['admin'])) return header('Location:/admin');

        $id = (int) $params[1];

        $post = $this->postManager->read(['id' => $id], 0, 0)[0];

        $this->render('/admin/post/preview.php', ['post' => $post]);
    }

    /**
     * @param array $params
     */
    public function edit(array $params)
    {
        if (!isset($_SESSION['admin'])) return header('Location:/admin');

        $id = (int) $params[1];

        $post = $this->postManager->read(['id' => $id], 0, 0)[0];

        $error = null;

        if (!empty($_POST['title']) && !empty($_POST['slug']) && isset($_FILES['image']) && !empty($_POST['content']) && !empty($_POST['csrf_token'])) {

            if (isset($_SESSION['admin']['csrf_token']) && ($_SESSION['admin']['csrf_token'] !== $_POST['csrf_token'])) {
                $error = 'Failed access attempt.';
            }

            if ($error === null) {

                $imageResult = ImageHandler::upload($_FILES['image'], $this->uploadDir);

                // $result['error'] retourne une cha??ne de caract??res vide s'il n'y a pas d'image envoy??e ou si l'image envoy??e est valide.
                if ($imageResult['error'] === '') {

                    $newTitle = htmlspecialchars($_POST['title']);
                    $newSlug = TextToSlug::convert(htmlspecialchars($_POST['slug']));
                    $enabled = (int) isset($_POST['enabled']);
                    $data = [
                        'title' => $newTitle,
                        'slug' => $newSlug,
                        'content' => htmlspecialchars($_POST['content']),
                        'enabled' => $enabled
                    ];

                    // Si une image est envoy??e, remplace le nom de l'image et supprime l'ancienne image
                    if ($imageResult['file_name'] !== '') {
                        ImageHandler::createThumb($imageResult['file_name'], $this->uploadDir);
                        $data['image'] = $imageResult['file_name'];
                        $this->deleteImage($post->getImage());
                    }

                    $this->postManager->update($data, $id);
                    header('Location:/admin');
                } else {
                    $error = $imageResult['error'];
                }
            }
        }

        $this->render('/admin/post/edit.php', [
            'post' => $post,
            'error' => $error,
            'csrf_token' => $_SESSION['admin']['csrf_token']
        ]);
    }

    /**
     * @param array $params
     */
    public function delete(array $params)
    {
        if (!isset($_SESSION['admin'])) return header('Location:/admin');

        $id = (int) $params[1];

        $post = $this->postManager->read(['id' => $id], 0, 0)[0];

        $error = null;

        if (!empty($_POST['delete']) && ($_POST['delete'] == true) && !empty($_POST['csrf_token'])) {

            if (isset($_SESSION['admin']['csrf_token']) && ($_SESSION['admin']['csrf_token'] !== $_POST['csrf_token'])) {
                $error = 'Failed access attempt.';
            }

            if ($error === null) {
                $this->postManager->delete($id);
                $this->deleteImage($post->getImage());
                header('Location:/admin');
            }
        }

        $this->render('/admin/post/delete.php', [
            'post' => $post,
            'error' => $error,
            'csrf_token' => $_SESSION['admin']['csrf_token']
        ]);
    }

    /**
     * @params string $fileName
     * @return void
     */
    private function deleteImage(string $fileName): void
    {
        $imageToDelete = $this->uploadDir . $fileName;
        
        if (file_exists($imageToDelete)) unlink($imageToDelete);
        
        $imageToDelete = $this->uploadDir . pathinfo($fileName, PATHINFO_FILENAME) . '-min.' . pathinfo($fileName, PATHINFO_EXTENSION);
        
        if (file_exists($imageToDelete)) unlink($imageToDelete);
    }
}
