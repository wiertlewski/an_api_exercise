<?php

namespace Arek\Exercise\User;

use Arek\Exercise\ApiException;
use Arek\Exercise\DbHelper;

class Table
{
    const TABLE_NAME = 'users';
    const ID_FIELD = 'id';
    const EMAIL_FIELD = 'email';

    private $dbHelper;

    public function __construct(DbHelper $dbHelper)
    {
        $this->dbHelper = $dbHelper;
    }

    public function getById(int $identifier)
    {
        return $this->dbHelper->findBy(self::TABLE_NAME, self::ID_FIELD, $identifier);
    }

    public function getByEmail(string $email)
    {
        return $this->dbHelper->findBy(self::TABLE_NAME, self::EMAIL_FIELD, $email);
    }

    public function get()
    {
        return $this->dbHelper->find(self::TABLE_NAME);
    }

    public function create(array $data)
    {
        $result = $this->dbHelper->insert(self::TABLE_NAME, [
            'email' => $data['email'],
            'forename' => $data['forename'],
            'surname' => $data['surname'],
            'created' => time(),
            'updated' => time(),
        ]);

        if (!$result) {
            throw new ApiException('Golf');
        }
    }

    public function update(array $data, int $identifier)
    {
        $result = $this->dbHelper->update(self::TABLE_NAME, [
            'email' => $data['email'],
            'forename' => $data['forename'],
            'surname' => $data['surname'],
            'updated' => time(),
        ], self::ID_FIELD, $identifier);

        if (!$result) {
            throw new ApiException('Hotel');
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
