<?php
use PHPUnit\Framework\TestCase;
use UserClasses\ {
    BusinessLayer\License,
    BusinessObjects\SystemLicenseBO,
    DataLayer\SystemLicenseDL
};
    
require_once 'vendor/UserClasses/BusinessLayer/src/License.php';

require __DIR__.'/../vendor/autoload.php';

/**
 * License test case.
 */
class LicenseTest extends TestCase
{

    /**
     *
     * @var License
     */
    private $license;
    private $data;
    private $arr_add;
    private $arr_update;
    private $arr_results;
    private $deleteObj;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated LicenseTest::setUp()
        
        $this->license = new License();
        $this->data=new SystemLicenseBO();
        $this->deleteObj=new SystemLicenseDL();
        //prepare test data
        
        $arr_addr=array();
        $arr_addr["AddressType"]=1;
        $arr_addr["AddressLine1"]="C13 Windmills, Muller South Street";
        $arr_addr["Surburb"]="Buccleuch";
        $arr_addr["City"]="Johannesburg";
        $arr_addr["Country"]="South Africa";
        $arr_addr["PostalCode"]="2066";
        $arr_add=array();
        $arr_add["companyName"]="CSIR";
        $arr_add["postalAddressArray"]=$arr_addr;
        $arr_add["licenseLimit"]=5;
        $arr_add["staffNumber"]="305941";
        $this->arr_add=$arr_add;
        //prepare update test data
        $arr_addr["AddressType"]=1;
        $arr_addr["AddressLine1"]="193 Fenniscowles Rd";
        $arr_addr["Surburb"]="Umbilo";
        $arr_addr["City"]="Durban";
        $arr_addr["Country"]="South Africa";
        $arr_addr["PostalCode"]="4001";   
        $arr_update=array();
        $arr_update["licenseID"]=1;     //defailt Primary Key value
        $arr_update["companyName"]="Gqunsu Engineering Pty Ltd";
        $arr_update["postalAddressArray"]=$arr_addr;
        $arr_update["licenseLimit"]=5;
        $arr_update["staffNumber"]="305941";
        $this->arr_update=$arr_update;
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated LicenseTest::tearDown()
        $this->license = null;
        $this->data=null;
        $this->deleteObj=null;
        
        parent::tearDown();
    }    

    /**
     * Tests License->listLicenseData()
     */
    public function testListLicenseDataWhenDataDoesNotExist()
    {
        // TODO Auto-generated LicenseTest->testListLicenseData()
        //$this->markTestIncomplete("listLicenseData test not implemented");
        $this->deleteObj->delete($this->arr_add);   //Make sure database is empty
        $this->data->set($this->arr_add);
        $arr=$this->license->listLicenseData($this->data);        
        $this->assertEquals(0,count($arr));
    }

    /**
     * Tests License->checkLicenseExists()
     */
    public function testCheckLicenseExistsWhenItDoesNotExist()
    {
        // TODO Auto-generated LicenseTest->testCheckLicenseExists()
        //$this->markTestIncomplete("checkLicenseExists test not implemented");
        //load test license data into SystemLicenseBO object
        $this->deleteObj->delete($this->arr_add);   //Make sure database is empty
        $this->data->set($this->arr_add);
        $status=$this->license->checkLicenseExists($this->data);
        $this->assertEquals(FALSE,$status);
    }

    /**
     * Tests License->addLicense()
     */
    public function testAddLicenseWithEverythingOK()
    {
        // TODO Auto-generated LicenseTest->testAddLicense()
        //$this->markTestIncomplete("addLicense test not implemented");
        
        //load test license data into SystemLicenseBO object
        $this->data->set($this->arr_add);
        $status=$this->license->addLicense($this->data);
        $this->assertEquals(TRUE,$status);
    } 
    
    public function testListLicenseDataWhenDataDoesExist()
    {
        // TODO Auto-generated LicenseTest->testListLicenseData()
        //$this->markTestIncomplete("listLicenseData test not implemented");
        $this->data->set($this->arr_add);
        $arr=$this->license->listLicenseData($this->data);        
        $this->assertEquals(4,count($arr));
    }
    
    public function testCheckLicenseExistsWhenItDoesExist()
    {
        // TODO Auto-generated LicenseTest->testCheckLicenseExists()
        //$this->markTestIncomplete("checkLicenseExists test not implemented");
        
        $this->data->set($this->arr_add);
        $status=$this->license->checkLicenseExists($this->data);
        $this->assertEquals(TRUE,$status);
    }

    /**
     * Tests License->updateLicense()
     */
    public function testUpdateLicenseWithOKData()
    {
        // TODO Auto-generated LicenseTest->testUpdateLicense()
        //$this->markTestIncomplete("updateLicense test not implemented");
        //load test license data into SystemLicenseBO object
        $arr=$this->license->listLicenseData($this->data); 
        $this->arr_update["licenseID"]=(int)$arr["licenseID"];
        $this->data->set($this->arr_update);
        $status=$this->license->updateLicense($this->data);
        $this->assertEquals(TRUE,$status);
    }   
   
  
}

