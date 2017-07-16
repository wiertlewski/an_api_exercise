<?php

use Arek\Exercise\HttpStatus;

final class DeleteUserActionTest extends AbstractTestCase
{
    public function testUpdateUser()
    {
        $identifier = 1;

        $userTable = \Mockery::mock('UserTable');
        $userTable->shouldReceive('getById')->times(1)->with($identifier)->andReturn(true);
        $userTable->shouldReceive('delete')->times(1)->with($identifier)->andReturn(true);

        $response = (new \Arek\Exercise\Action\User\Delete)(
            $this->getContainer(['userTable' => $userTable]),
            $this->getRequest('DELETE', '/user/' . $identifier),
            $this->getResponse(),
            ['id' => $identifier]
        );

        $this->assertEquals($response->getBody(), json_encode([
            'status' => HttpStatus::OK,
            'success' => 'User has been deleted'
        ]));
    }

    /**
     * @expectedException \Arek\Exercise\ApiException
     * @expectedExceptionMessage Echo
     */
    public function testUserWithRequestedIdentifierNotFound()
    {
        $identifier = 1;

        $userTable = \Mockery::mock('UserTable');
        $userTable->shouldReceive('getById')->times(1)->with($identifier)->andReturn(false);

        $response = (new \Arek\Exercise\Action\User\Delete)(
            $this->getContainer(['userTable' => $userTable]),
            $this->getRequest('DELETE', '/user/' . $identifier),
            $this->getResponse(),
            ['id' => $identifier]
        );

        $this->expectException(\Arek\Exercise\ApiException::class);
    }
}
