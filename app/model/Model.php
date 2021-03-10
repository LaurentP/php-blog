<?php

namespace App\Model;

use PDO;
use PDOStatement;

abstract class Model
{
    /**
     * @var PDO
     */
    private $dbh;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var string
     */
    protected $object;

    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * @param string $request
     * @param array $data
     * @return PDOStatement
     */
    public function execute(string $request, array $data): PDOStatement
    {
        $pdoStatement = $this->dbh->prepare($request);
        $pdoStatement->execute($data);

        // Debug
        // echo '<pre>', $pdoStatement->debugDumpParams(), '</pre>';

        return $pdoStatement;
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        $keys = array_keys($data);
        $cols = implode(', ', $keys);
        $tokens = ':' . implode(', :', $keys);

        $request = "INSERT INTO $this->table ($cols) VALUES ($tokens)";

        $this->execute($request, $data);
    }

    /**
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function read(array $where, int $limit, int $offset)
    {
        $countWhere = count($where);

        if ($countWhere > 0) {
            $request = 'SELECT * FROM ' . $this->table . ' WHERE ';

            $i = 0;
            $keys = array_keys($where);
            foreach ($keys as $col) {
                $request .= "$col = :$col";
                $i++;
                if ($i < $countWhere) {
                    $request .= ' AND ';
                }
            }

            $request .= ' ORDER BY id DESC';
        } else {
            $request = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC';
        }

        if ($limit > 0) {
            $request .= " LIMIT $limit OFFSET $offset";
        }

        $pdoStatement = $this->execute($request, $where);

        $data = $pdoStatement->fetchAll(PDO::FETCH_CLASS, $this->object);

        return $data;
    }

    /**
     * @param array $where
     */
    public function count(array $where)
    {
        $request = 'SELECT COUNT(*) FROM ' . $this->table;

        $countWhere = count($where);

        if ($countWhere > 0) {
            $request .= ' WHERE ';

            $i = 0;
            $keys = array_keys($where);
            foreach ($keys as $col) {
                $request .= "$col = :$col";
                $i++;
                if ($i < $countWhere) {
                    $request .= ' AND ';
                }
            }
        }

        $pdoStatement = $this->execute($request, $where);

        return $pdoStatement->fetchColumn();
    }

    /**
     * @param array $data
     * @param int $id
     * @return void
     */
    public function update(array $data, int $id): void
    {
        $request = 'UPDATE ' . $this->table . ' SET ';

        $i = 0;
        $keys = array_keys($data);

        foreach ($keys as $key) {
            if ($i > 0) {
                $request .= ', ';
            }
            $i++;
            $request .= "$key = :$key";
        }

        $request .= ' WHERE id = :id';

        $data['id'] = $id;

        $this->execute($request, $data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $request = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $data['id'] = $id;

        $this->execute($request, $data);
    }
}
