<?php

namespace Arek\Exercise\Action\User;

use Arek\Exercise\ApiException;
use Arek\Exercise\HttpStatus;

class Update
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke($container, $request, $response, $arguments)
    {
        $validatedBody = $container->userValidator->validate($request->getParsedBody());

        if (!$container->userTable->getById($arguments['id'])) {
            throw new ApiException('Echo');
        }

        $this->emailMustBeUnique($container->userTable, $validatedBody['email'], $arguments['id']);

        $container->userTable->update($validatedBody, $arguments['id']);

        return $response->withJson([
            'status' => HttpStatus::OK,
            'success' => 'User has been updated',
        ], HttpStatus::OK);
    }

    private function emailMustBeUnique($userTable, $email, $identifier)
    {
        $user = $userTable->getByEmail($email);

        if ($user && $user['id'] != $identifier) {
            throw new ApiException('Foxtrot');
        }
    }
}
