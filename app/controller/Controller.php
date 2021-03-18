<?php

namespace App\Controller;

use PDO;

abstract class Controller
{
    /**
     * @var PDO
     */
    protected $dbh;

    public function __construct()
    {
        session_start();

        try {
            $this->dbh = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function render(string $target, array $params = [])
    {
        $pageLayout = null;

        ob_start();

        require_once ROOT_DIRECTORY . '/app/view' . $target;

        $pageContent = ob_get_clean();

        if ($pageLayout !== null) {
            require_once $pageLayout;
        }
        else {
            echo $pageContent;
        }
    }
}