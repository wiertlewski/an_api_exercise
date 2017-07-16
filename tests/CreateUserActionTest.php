<?php

use Arek\Exercise\HttpStatus;

final class CreateUserActionTest extends AbstractTestCase
{
    public function testCreateUser()
    {
        $parsedBody = [
            'email' => 'test@tester.com',
            'forename' => 'Test',
            'surname' => 'Tester',
        ];

        $userValidator = \Mockery::mock('UserValidator');
        $userValidator->shouldReceive('validate')->times(1)->with($parsedBody)->andReturn($parsedBody);

        $userTable = \Mockery::mock('UserTable');
        $userTable->shouldReceive('getByEmail')->times(1)->with($parsedBody['email'])->andReturn(false);
        $userTable->shouldReceive('create')->times(1)->with($parsedBody)->andReturn(true);

        $request = $this->getRequest('POST', '/user');
        $request = $request->withParsedBody($parsedBody);

        $response = (new \Arek\Exercise\Action\User\Create)(
            $this->getContainer(['userValidator' => $userValidator, 'userTable' => $userTable]),
            $request,
            $this->getResponse(),
            []
        );

        $this->assertEquals($response->getBody(), json_encode([
            'status' => HttpStatus::OK,
            'success' => 'User has been created'
        ]));
    }

    /**
     * @expectedException \Arek\Exercise\ApiException
     * @expectedExceptionMessage Foxtrot
     */
    public function testUserWithRequestedEmailAlreadyExists()
    {
        $parsedBody = [
            'email' => 'test@tester.com',
            'forename' => 'Test',
            'surname' => 'Tester',
        ];

        $userValidator = \Mockery::mock('UserValidator');
        $userValidator->shouldReceive('validate')->times(1)->with($parsedBody)->andReturn($parsedBody);

        $userTable = \Mockery::mock('UserTable');
        $userTable->shouldReceive('getByEmail')->times(1)->with($parsedBody['email'])->andReturn(true);

        $request = $this->getRequest('POST', '/user');
        $request = $request->withParsedBody($parsedBody);

        $response = (new \Arek\Exercise\Action\User\Create)(
            $this->getContainer(['userValidator' => $userValidator, 'userTable' => $userTable]),
            $request,
            $this->getResponse(),
            []
        );

        $this->expectException(\Arek\Exercise\ApiException::class);
    }
}
