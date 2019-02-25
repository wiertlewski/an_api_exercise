<?php

namespace Arek\Exercise\Size;

use Arek\Exercise\ApiException;

class Validator
{
    public function validate(array $data)
    {
        $this->validateSize($data['size']);

        return [
            'size' => $data['size'],
        ];
    }

    private function validateSize($size)
    {
        if (empty($size)) {
            throw new ApiException('Bravo');
        } elseif (!is_numeric($size)) {
            throw new ApiException('Juliet');
        }
    }
}
