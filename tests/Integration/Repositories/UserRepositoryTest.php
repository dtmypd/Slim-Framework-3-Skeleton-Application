<?php namespace App\Repositories;

use App\Entities\User;
use ExtendedSlim\App;
use ExtendedSlim\App\Config;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use ExtendedSlim\Tests\Integration\AbstractIntegrationTest;
use PHPUnit_Framework_MockObject_MockObject;

class UserRepositoryTest extends AbstractIntegrationTest
{
    public function setupEnv()
    {
        (new Config(realpath(__DIR__ . "/../../../")))->envSetup();
    }


    /** @return PHPUnit_Framework_MockObject_MockObject|UserRepository */
    private function getUserRepositoryMock()
    {
        return $this->createMock(UserRepository::class);
    }

    /**
     * @test
     * @throws RecordNotFoundException
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
