<?php

namespace Arek\Exercise\Size;

use Arek\Exercise\ApiException;
use Arek\Exercise\DbHelper;

class Table
{
    const TABLE_NAME = 'sizes';
    const ID_FIELD = 'id';
    const SIZE_FIELD = 'size';

    private $dbHelper;

    public function __construct(DbHelper $dbHelper)
    {
        $this->dbHelper = $dbHelper;
    }

    public function get()
    {
        return $this->dbHelper->find(self::TABLE_NAME);
    }

    public function getById(int $identifier)
    {
        return $this->dbHelper->findBy(self::TABLE_NAME, self::ID_FIELD, $identifier);
    }

    public function getBySize(int $size)
    {
        return $this->dbHelper->findBy(self::TABLE_NAME, self::SIZE_FIELD, $size);
    }

    public function create(array $data)
    {
        $result = $this->dbHelper->insert(self::TABLE_NAME, [
            'size' => $data['size'],
        ]);

        if (!$result) {
            throw new ApiException('Golf');
        }
    }

    public function delete(int $identifier)
    {
        $result = $this->dbHelper->delete(self::TABLE_NAME, self::ID_FIELD, $identifier);

        if (!$result) {
            throw new ApiException('India');
        }
    }
}
