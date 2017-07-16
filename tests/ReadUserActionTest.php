<?php

use Arek\Exercise\HttpStatus;

final class ReadUserActionTest extends AbstractTestCase
{
    public function testGetUserById()
    {
        $identifier = 1;

        $userTable = \Mockery::mock('UserTable');
        $userTable->shouldReceive('getById')->times(1)->with($identifier)->andReturn($identifier);

        $response = (new \Arek\Exercise\Action\User\Read)(
            $this->getContainer(['userTable' => $userTable]),
            $this->getRequest('GET', '/user', 'id=' . $identifier),
            $this->getResponse(),
            []
        );

        $this->assertEquals($response->getBody(), json_encode(['status' => HttpStatus::OK, 'data' => $identifier]));
    }

    public function testGetUserByEmail()
    {
        $email = 'test@tester.com';

        $userTable = \Mockery::mock('UserTable');
        $userTable->shouldReceive('getByEmail')->times(1)->with($email)->andReturn($email);

        $response = (new \Arek\Exercise\Action\User\Read)(
            $this->getContainer(['userTable' => $userTable]),
            $this->getRequest('GET', '/user', 'email=' . $email),
            $this->getResponse(),
            []
        );

        $this->assertEquals($response->getBody(), json_encode(['status' => HttpStatus::OK, 'data' => $email]));
    }

    public function testGetUsers()
    {
        $result = true;

        $userTable = \Mockery::mock('UserTable');
        $userTable->shouldReceive('get')->times(1)->andReturn($result);

        $response = (new \Arek\Exercise\Action\User\Read)(
            $this->getContainer(['userTable' => $userTable]),
            $this->getRequest('GET', '/user'),
            $this->getResponse(),
            []
        );

        $this->assertEquals($response->getBody(), json_encode(['status' => HttpStatus::OK, 'data' => $result]));
    }
}
