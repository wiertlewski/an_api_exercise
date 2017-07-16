<?php

namespace Arek\Exercise\User;

use Arek\Exercise\ApiException;

class Validator
{
    public function validate(array $data)
    {
        $this->validateEmail($data['email']);
        $this->validateForename($data['forename']);
        $this->validateSurname($data['surname']);

        return [
            'email' => $data['email'],
            'forename' => $data['forename'],
            'surname' => $data['surname'],
        ];
    }

    private function validateEmail($email)
    {
        if (empty($email)) {
            throw new ApiException('Bravo');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ApiException('Juliet');
        }
    }

    private function validateForename($forename)
    {
        if (empty($forename)) {
            throw new ApiException('Charlie');
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $forename)) {
            throw new ApiException('Kilo');
        }
    }

    private function validateSurname($surname)
    {
        if (empty($surname)) {
            throw new ApiException('Delta');
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
            throw new ApiException('Lima');
        }
    }
}
