<?php
use PHPUnit\Framework\TestCase;
use UserClasses\BusinessLayer\LoginCredentials;

require_once 'vendor/UserClasses/BusinessLayer/src/LoginCredentials.php';

/**
 * LoginCredentials test case.
 */
class LoginCredentialsTest extends TestCase
{

    /**
     *
     * @var LoginCredentials
     */
    private $loginCredentials;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated LoginCredentialsTest::setUp()
        
        $this->loginCredentials = new LoginCredentials();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated LoginCredentialsTest::tearDown()
        $this->loginCredentials = null;
        
        parent::tearDown();
    }  

    /**
     * Tests LoginCredentials->findUserAccountMatch()
     */
    public function testFindUserAccountMatch()
    {
        // TODO Auto-generated LoginCredentialsTest->testFindUserAccountMatch()
        $this->markTestIncomplete("findUserAccountMatch test not implemented");
        
        $this->loginCredentials->findUserAccountMatch(/* parameters */);
    }

    /**
     * Tests LoginCredentials->updateUserPassword()
     */
    public function testUpdateUserPassword()
    {
        // TODO Auto-generated LoginCredentialsTest->testUpdateUserPassword()
        $this->markTestIncomplete("updateUserPassword test not implemented");
        
        $this->loginCredentials->updateUserPassword(/* parameters */);
    }

    /**
     * Tests LoginCredentials->resetUserPassword()
     */
    public function testResetUserPassword()
    {
        // TODO Auto-generated LoginCredentialsTest->testResetUserPassword()
        $this->markTestIncomplete("resetUserPassword test not implemented");
        
        $this->loginCredentials->resetUserPassword(/* parameters */);
    }
}

