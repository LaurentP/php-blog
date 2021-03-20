<?php

namespace App\Controller;

use App\Asset\TextToSlug;
use App\Model\PostManager;
use App\Asset\ImageUploader;

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

        if (!empty($_POST['title']) && isset($_FILES['image']) && !empty($_POST['content'])) {

            $result = ImageUploader::upload($_FILES['image'], $this->uploadDir);

            // $result['error'] retourne une chaîne de caractères vide s'il n'y a pas d'image envoyée ou si l'image envoyée est valide.
            if ($result['error'] === '') {
                $newTitle = htmlspecialchars($_POST['title']);
                $newSlug = TextToSlug::convert($newTitle);
                $imageFileName = $result['file_name'];
                $enabled = (int) isset($_POST['enabled']);
                $data = [
                    'title' => $newTitle,
                    'slug' => $newSlug,
                    'image' => $imageFileName,
                    'content' => htmlspecialchars($_POST['content']),
                    'created_at' => date('Y-m-d H:i:s'),
                    'enabled' => $enabled
                ];

                $this->postManager->create($data);
                header('Location:/admin');
            } else {
                $error = $result['error'];
            }
        }

        $this->render('/admin/post/new.php', [
            'error' => $error
        ]);
    }

    /**
     * @param array $params
     */
    public function edit(array $params)
    {
        if (!isset($_SESSION['admin'])) return header('Location:/admin');

        $id = (int) $params[1];

        $postList = $this->postManager->read(['id' => $id], 0, 0);

        $error = null;

        if (!empty($_POST['title']) && !empty($_POST['slug']) && isset($_FILES['image']) && !empty($_POST['content'])) {

            $result = ImageUploader::upload($_FILES['image'], $this->uploadDir);

            // $result['error'] retourne une chaîne de caractères vide s'il n'y a pas d'image envoyée ou si l'image envoyée est valide.
            if ($result['error'] === '') {

                $newTitle = htmlspecialchars($_POST['title']);
                $newSlug = TextToSlug::convert(htmlspecialchars($_POST['slug']));
                $enabled = (int) isset($_POST['enabled']);
                $data = [
                    'title' => $newTitle,
                    'slug' => $newSlug,
                    'content' => htmlspecialchars($_POST['content']),
                    'enabled' => $enabled
                ];

                // Si une image est envoyée, remplace le nom de l'image et supprime l'ancienne image
                if ($result['file_name'] !== '') {
                    $data['image'] = $result['file_name'];
                    $imageToDelete = $this->uploadDir . $postList[0]->getImage();
                    if (file_exists($imageToDelete)) {
                        unlink($imageToDelete);
                    }
                    $imageToDelete = $this->uploadDir . pathinfo($postList[0]->getImage(), PATHINFO_FILENAME) . '-min.' . pathinfo($postList[0]->getImage(), PATHINFO_EXTENSION);
                    if (file_exists($imageToDelete)) {
                        unlink($imageToDelete);
                    }
                }

                $this->postManager->update($data, $id);
                header('Location:/admin');
            } else {
                $error = $result['error'];
            }
        }

        $this->render('/admin/post/edit.php', [
            'post' => $postList[0],
            'error' => $error
        ]);
    }

    /**
     * @param array $params
     */
    public function delete(array $params)
    {
        if (!isset($_SESSION['admin'])) return header('Location:/admin');

        $id = (int) $params[1];

        $postList = $this->postManager->read(['id' => $id], 0, 0);

        if (!empty($_POST['delete']) && ($_POST['delete'] == true)) {
            $this->postManager->delete($id);
            $imageToDelete = $this->uploadDir . $postList[0]->getImage();
            if (file_exists($imageToDelete)) {
                unlink($imageToDelete);
            }
            $imageToDelete = $this->uploadDir . pathinfo($postList[0]->getImage(), PATHINFO_FILENAME) . '-min.' . pathinfo($postList[0]->getImage(), PATHINFO_EXTENSION);
            if (file_exists($imageToDelete)) {
                unlink($imageToDelete);
            }
            header('Location:/admin');
        } else {
            $this->render('/admin/post/delete.php', [
                'post' => $postList[0]
            ]);
        }
    }
}
