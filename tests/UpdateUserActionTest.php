<?php

use Arek\Exercise\HttpStatus;

final class UpdateUserActionTest extends AbstractTestCase
{
    public function testUpdateUser()
    {
        $identifier = 1;

        $parsedBody = [
            'email' => 'test@tester.com',
            'forename' => 'Test',
            'surname' => 'Tester',
        ];

        $userValidator = \Mockery::mock('UserValidator');
        $userValidator->shouldReceive('validate')->times(1)->with($parsedBody)->andReturn($parsedBody);

        $userTable = \Mockery::mock('UserTable');
        $userTable->shouldReceive('getById')->times(1)->with($identifier)->andReturn(true);
        $userTable->shouldReceive('update')->times(1)->with($parsedBody, $identifier)->andReturn(true);

        $request = $this->getRequest('PUT', '/user/' . $identifier);
        $request = $request->withParsedBody($parsedBody);

        $response = (new \Arek\Exercise\Action\User\Update)(
            $this->getContainer(['userValidator' => $userValidator, 'userTable' => $userTable]),
            $request,
            $this->getResponse(),
            ['id' => $identifier]
        );

        $this->assertEquals($response->getBody(), json_encode([
            'status' => HttpStatus::OK,
            'success' => 'User has been updated'
        ]));
    }

    /**
     * @expectedException \Arek\Exercise\ApiException
     * @expectedExceptionMessage Echo
     */
    public function testUserWithRequestedIdentifierNotFound()
    {
        $identifier = 1;

        $parsedBody = [
            'email' => 'test@tester.com',
            'forename' => 'Test',
            'surname' => 'Tester',
        ];

        $userValidator = \Mockery::mock('UserValidator');
        $userValidator->shouldReceive('validate')->times(1)->with($parsedBody)->andReturn($parsedBody);

        $userTable = \Mockery::mock('UserTable');
        $userTable->shouldReceive('getById')->times(1)->with($identifier)->andReturn(false);

        $request = $this->getRequest('PUT', '/user/' . $identifier);
        $request = $request->withParsedBody($parsedBody);

        $response = (new \Arek\Exercise\Action\User\Update)(
            $this->getContainer(['userValidator' => $userValidator, 'userTable' => $userTable]),
            $request,
            $this->getResponse(),
            ['id' => $identifier]
        );

        $this->expectException(\Arek\Exercise\ApiException::class);
    }
}
