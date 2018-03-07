<?php namespace App\Repositories;

use App\Entities\User;
use ExtendedSlim\App;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use Integration\IntegrationTestBase;
use PHPUnit_Framework_MockObject_MockObject;
use ReflectionException;

class UserRepositoryTest extends IntegrationTestBase
{
    /**
     * @return PHPUnit_Framework_MockObject_MockObject|UserRepository
     * @throws ReflectionException
     */
    private function getUserRepositoryMock()
    {
        return $this->createMock(UserRepository::class);
    }

    /**
     * @test
     * @throws RecordNotFoundException
     * @throws ReflectionException
     */
    public function findByName_MockCall_WillReturnWithMockedData()
    {
        // Arrange
        $userId           = 1;
        $expectedUserId   = 1;
        $userName         = 'bela';
        $expectedUserName = 'bela';

        $userRepositoryMock = $this->getUserRepositoryMock();
        $userRepositoryMock
            ->method('findByName')
            ->willReturn(new User($userId, $userName));

        // Act
        $response = $userRepositoryMock->findByName($userName);

        // Assert
        $this->assertEquals($expectedUserId, $response->getId(), 'User id mismatch.');
        $this->assertEquals($expectedUserName, $response->getUserName(), 'User name mismatch.');
    }
}
