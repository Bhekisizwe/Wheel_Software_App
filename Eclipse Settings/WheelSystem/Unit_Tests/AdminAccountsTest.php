<?php
use PHPUnit\Framework\TestCase;
use UserClasses\BusinessLayer\AdminAccounts;
use UserClasses\DataLayer\UserAccountDL;
use UserClasses\BusinessObjects\UserAccountBO;
use UserClasses\BusinessLayer\UserAccounts;

require_once 'vendor/UserClasses/BusinessLayer/src/AdminAccounts.php';

/**
 * AdminAccounts test case.
 */
class AdminAccountsTest extends TestCase
{

    /**
     *
     * @var AdminAccounts
     */
    protected $adminAccounts;
    protected $userAccountDL;
    protected $arr_add;
    protected $data;
    protected $userAccount;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated AdminAccountsTest::setUp()
        
        $this->adminAccounts = new AdminAccounts();
        $this->userAccountDL=new UserAccountDL();
        $this->data=new UserAccountBO();
        $this->userAccount=new UserAccounts();
        $arr_add=array();
        $arr_add["roleID"]="2";
        $arr_add["name"]="Bhekisizwe";
        $arr_add["surname"]="Mthethwa";
        $arr_add["staffNumber"]="305941";
        $arr_add["emailAddress"]="tshomie2020@yahoo.com";
        $arr_add["accountState"]=1;
        $this->arr_add=$arr_add;
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated AdminAccountsTest::tearDown()
        $this->adminAccounts = null;
        $this->userAccountDL=null;
        $this->data=null;
        $this->userAccount=null;
        parent::tearDown();
    }


     /**
     * Tests AdminAccounts->listAllAdminAccounts()
     */
    public function testListAllAdminAccountsWhenTheyDoNotExist()
    {
        // TODO Auto-generated AdminAccountsTest->testListAllAdminAccounts()
        //$this->markTestIncomplete("listAllAdminAccounts test not implemented");
        $arr_add=array();
        $this->userAccountDL->delete($arr_add);     //make sure we delete all user accounts
        $arr=$this->adminAccounts->listAllAdminAccounts();
        $this->assertEquals(0,count($arr));
    }
    
    public function testListAllAdminAccountsWhenTheyExist()
    {
        // TODO Auto-generated AdminAccountsTest->testListAllAdminAccounts()
        //$this->markTestIncomplete("listAllAdminAccounts test not implemented");
        $this->data->set($this->arr_add);
        $i=0;
        $counter=0;
        while($i<7){
            $status_message=$this->userAccount->addUserAccount($this->data);
            if($status_message){
                $counter++;        
            }else break;
            $i++;
        }        
        $arr=$this->adminAccounts->listAllAdminAccounts();
        $this->assertEquals(5,count($arr));
    }
}

