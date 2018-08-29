<?php
use PHPUnit\Framework\TestCase;
use UserClasses\BusinessLayer\UserAccounts;
use UserClasses\DataLayer\UserAccountDL;
use UserClasses\BusinessObjects\UserAccountBO;
use UserClasses\BusinessLayer\License;
use UserClasses\BusinessObjects\SystemLicenseBO;

require_once 'vendor/UserClasses/BusinessLayer/src/UserAccounts.php';

/**
 * UserAccounts test case.
 */
class UserAccountsTest extends TestCase
{

    /**
     *
     * @var UserAccounts
     */
    protected $userAccounts;
    protected $userAccountDL;
    protected $data;
    protected $arr_add;
    protected $arr_update;
    protected $licensedata;
    protected $license;
    protected $licenseBO;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated UserAccountsTest::setUp()
        
        $this->userAccounts = new UserAccounts();
        $this->userAccountDL=new UserAccountDL();
        $this->data=new UserAccountBO();
        $this->license=new License();
        $this->licenseBO=new SystemLicenseBO();
        $arr_addr=array();
        $arr_addr["AddressType"]=1;
        $arr_addr["AddressLine1"]="C13 Windmills, Muller South Street";
        $arr_addr["Surburb"]="Buccleuch";
        $arr_addr["City"]="Johannesburg";
        $arr_addr["Country"]="South Africa";
        $arr_addr["PostalCode"]="2066";
        $arr_add_lic=array();
        $arr_add_lic["companyName"]="CSIR";
        $arr_add_lic["postalAddressArray"]=$arr_addr;
        $arr_add_lic["licenseLimit"]=5;        
        $this->licensedata=$arr_add_lic;
        $arr_add=array();
        $arr_add["roleID"]="15";
        $arr_add["name"]="Bhekisizwe";
        $arr_add["surname"]="Mthethwa";
        $arr_add["staffNumber"]="305941";
        $arr_add["emailAddress"]="tshomie2020@yahoo.com";        
        $arr_add["accountState"]=1;
        $arr_add["adminStaffNumber"]="305941";
        $this->arr_add=$arr_add;
        $arr_update=array();
        $arr_update["accountID"]=1;
        $arr_update["actionCode"]="0xA101";
        $arr_update["roleID"]="1";
        $arr_update["name"]="Mzimkhulu";
        $arr_update["surname"]="Mthethwa";
        $arr_update["staffNumber"]="305941";
        $arr_update["emailAddress"]="bmthethwa@gqunsueng.co.za";
        $arr_update["passwordHash"]="induction";
        $arr_update["accountState"]=0;
        $arr_update["adminStaffNumber"]="305941";
        $this->arr_update=$arr_update;
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated UserAccountsTest::tearDown()
        $this->userAccounts = null;
        $this->userAccountDL=null;
        $this->data=null;
        $this->license=null;
        $this->licenseBO=null;
        parent::tearDown();
    }

    /**
     * Tests UserAccounts->listUserAccount()
     */
    public function testListUserAccountWhenItDoesNotExist()
    {
        // TODO Auto-generated UserAccountsTest->testListUserAccount()
        //$this->markTestIncomplete("listUserAccount test not implemented");        
        $arr=array();
        $arr["staffNumber"]="204512428";
        $this->userAccountDL->delete($arr);     //make sure we delete all user accounts
        $this->data->set($arr);
        $arr=$this->userAccounts->listUserAccount($this->data);
        $this->assertEquals(0,count($arr));
    }

    /**
     * Tests UserAccounts->checkUserAccountExists()
     */
    public function testCheckUserAccountExistsWhenItDoesNotExist()
    {
        // TODO Auto-generated UserAccountsTest->testCheckUserAccountExists()
        //$this->markTestIncomplete("checkUserAccountExists test not implemented");
        $arr=array();
        $arr["staffNumber"]="204512428";
        $this->userAccountDL->delete($arr);     //make sure we delete all user accounts
        $this->data->set($arr);
        $status_message=$this->userAccounts->checkUserAccountExists($this->data);
        $this->assertEquals(false,$status_message);        
    }

    /**
     * Tests UserAccounts->addUserAccount()
     */
    public function testAddUserAccountOnlyOneAccount()
    {
        // TODO Auto-generated UserAccountsTest->testAddUserAccount()
        //$this->markTestIncomplete("addUserAccount test not implemented");
        $this->data->set($this->arr_add);
        $status_message=$this->userAccounts->addUserAccount($this->data);
        $this->assertEquals(true,$status_message);
    }
    
    public function testListUserAccountWhenItDoesExist()
    {
        // TODO Auto-generated UserAccountsTest->testListUserAccount()
        //$this->markTestIncomplete("listUserAccount test not implemented");
        $arr=array();
        $arr["staffNumber"]="305941";        
        $this->data->set($arr);
        $arr_result=$this->userAccounts->listUserAccount($this->data);        
        $this->assertGreaterThan(5,count($arr_result));
    }
    
    public function testCheckUserAccountExistsWhenItDoesExist()
    {
        $arr=array();
        $arr["staffNumber"]="305941";
        $this->data->set($arr);
        $status_message=$this->userAccounts->checkUserAccountExists($this->data);
        $this->assertEquals(true,$status_message);  
    }
    
    public function testAddUserAccountUntilItExceedsLicenseLimit()
    {
        // TODO Auto-generated UserAccountsTest->testAddUserAccount()
        //$this->markTestIncomplete("addUserAccount test not implemented");
        $i=0;
        $counter=0; //count number of times successfully added a user account
        $this->userAccountDL->delete($this->arr_add);     //make sure we delete all user accounts
        //make sure the license data exists in database
        $this->licenseBO->set($this->licensedata);
        $this->license->addLicense($this->licenseBO);
        while($i<7){
            $this->arr_add["staffNumber"]="30594".($i+2);
            $this->data->set($this->arr_add);
            $status_message=$this->userAccounts->addUserAccount($this->data);
            if($status_message){
                $counter++;
            }
            $i++;
        }        
        $this->assertEquals(5,$counter);
    }

    /**
     * Tests UserAccounts->updateUserAccount()
     */
    public function testUpdateUserAccount()
    {
        // TODO Auto-generated UserAccountsTest->testUpdateUserAccount()
        //$this->markTestIncomplete("updateUserAccount test not implemented");
        $this->data->set($this->arr_update);
        $status=$this->userAccounts->updateUserAccount($this->data);
        $this->assertEquals(true,$status);
    }
}

