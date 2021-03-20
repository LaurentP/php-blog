<?php

namespace App\Model;

use PDO;

class PostManager extends Model
{
    protected $table = 'post';

    protected $object = 'App\Model\Post';

    public function search(array $enabled, string $query, int $limit, int $offset)
    {
        $data = ['query' => '%' . $query . '%'];

        $request = 'SELECT * FROM ' . $this->table . ' WHERE ';

        if (array_key_exists('enabled', $enabled)) {
            $request .= 'enabled = :enabled AND ';
            $data['enabled'] = $enabled['enabled'];
        }

        $request .= '(title LIKE :query OR content LIKE :query) ORDER BY id DESC';

        if ($limit > 0) $request .= " LIMIT $limit OFFSET $offset";

        $pdoStatement = $this->execute($request, $data);

        $data = $pdoStatement->fetchAll(PDO::FETCH_CLASS, $this->object);

        return $data;
    }

    public function searchCount(array $enabled, string $query)
    {
        $data = ['query' => '%' . $query . '%'];

        $request = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE ';

        if (array_key_exists('enabled', $enabled)) {
            $request .= 'enabled = :enabled AND ';
            $data['enabled'] = $enabled['enabled'];
        }

        $request .= '(title LIKE :query OR content LIKE :query) ORDER BY id DESC';

        $pdoStatement = $this->execute($request, $data);

        return $pdoStatement->fetchColumn();
    }
}