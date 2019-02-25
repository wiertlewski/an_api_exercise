<?php

namespace Arek\Exercise;

class DbHelper extends \Pdo
{
    public function __construct($config)
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $config['host'], $config['dbname']);

        parent::__construct($dsn, $config['username'], $config['password'], [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ]);
    }

    public function find(string $table)
    {
        $sql = sprintf('SELECT * FROM %s;', $table);
        $query = $this->execute($sql);

        return $query ? $query->fetchAll() : false;
    }

    public function findBy(string $table, string $key, $value)
    {
        $sql = sprintf('SELECT * FROM %s WHERE %2$s = :%2$s;', $table, $key);
        $query = $this->execute($sql, array($key => $value));

        return $query ? $query->fetch() : false;
    }

    public function insert(string $table, array $data)
    {
        $fields = array_keys($data);

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (:%s);',
            $table,
            implode(", ", $fields),
            implode(', :', $fields)
        );

        return $this->execute($sql, $data);
    }

    public function delete(string $table, string $key, $value)
    {
        $sql = sprintf('DELETE FROM %s WHERE %2$s = :%2$s;', $table, $key);
        $data = array($key => $value);

        return $this->execute($sql, $data);
    }

    private function execute(string $sql, array $data = array())
    {
        $query = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $query->bindValue(':' . $key, $value);
        }

        return $query->execute() ? $query : false;
    }
}
