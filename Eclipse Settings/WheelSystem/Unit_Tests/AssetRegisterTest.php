<?php
use PHPUnit\Framework\TestCase;
use UserClasses\BusinessLayer\AssetRegister;
use UserClasses\BusinessObjects\AssetRegisterBO;
use UserClasses\DataLayer\AssetRegisterDL;

require_once 'vendor/UserClasses/BusinessLayer/src/AssetRegister.php';

/**
 * AssetRegister test case.
 */
class AssetRegisterTest extends TestCase
{

    /**
     *
     * @var AssetRegister
     */
    protected $assetRegister;
    protected $arr_add;
    protected $arr_update;
    protected $assetRegisterBO;
    protected $assetRegisterDL;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated AssetRegisterTest::setUp()
        
        $this->assetRegister = new AssetRegister();
        $this->assetRegisterBO=new AssetRegisterBO();
        $this->assetRegisterDL=new AssetRegisterDL();
        $arr_add=array();
        $arr_add["staffNumber"]="305941";
        $arr_add["coachDetails2DArray"][0]["coachType"]="10M5";
        $arr_add["coachDetails2DArray"][0]["coachCategory"]="M";
        $arr_add["coachNumber"]="10M51008";
        $this->arr_add=$arr_add;
        $arr_update=array();
        $arr_update["staffNumber"]="305941";
        $arr_update["assetID"]=1;
        $arr_update["coachDetails2DArray"][0]["coachID"]=1;
        $arr_update["coachDetails2DArray"][0]["coachType"]="10M2T";
        $arr_update["coachDetails2DArray"][0]["coachCategory"]="T";
        $arr_update["coachNumber"]="10M29988T";
        $this->arr_update=$arr_update;
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated AssetRegisterTest::tearDown()
        $this->assetRegister = null;
        $this->assetRegisterBO=null;
        $this->assetRegisterDL=null;
        parent::tearDown();
    }   
 
    
    /**
     * Tests AssetRegister->searchAssetRegister()
     */
    public function testSearchAssetRegisterWhenAssetDoesNotExist()
    {
        // TODO Auto-generated AssetRegisterTest->testSearchAssetRegister()
        //$this->markTestIncomplete("searchAssetRegister test not implemented");
        $arr=array();
        $this->assetRegisterDL->delete($arr);   //make sure we delete previous data
        $arr["coachNumber"]="10M51008";
        $this->assetRegisterBO->set($arr);
        $arr_result=$this->assetRegister->searchAssetRegister($this->assetRegisterBO);
        $this->assertEquals(0,count($arr_result));
    }
    
    public function testCheckAssetExistsWhenItDoesNotExist()
    {
        // TODO Auto-generated AssetRegisterTest->testCheckAssetExists()
        //$this->markTestIncomplete("checkAssetExists test not implemented");
        $arr=array();
        $this->assetRegisterDL->delete($arr);   //make sure we delete previous data
        $arr["coachNumber"]="10M51008";
        $this->assetRegisterBO->set($arr);
        $status_message=$this->assetRegister->checkAssetExists($this->assetRegisterBO);
        $this->assertEquals(false,$status_message);
    }

    /**
     * Tests AssetRegister->addAsset()
     */
    public function testAddAsset()
    {
        // TODO Auto-generated AssetRegisterTest->testAddAsset()
        //$this->markTestIncomplete("addAsset test not implemented");
        $this->assetRegisterBO->set($this->arr_add);
        $status_message=$this->assetRegister->addAsset($this->assetRegisterBO);
        $this->assertEquals(true,$status_message);
    }
    
    public function testAddAssetRepeatedly()
    {
        // TODO Auto-generated AssetRegisterTest->testAddAsset()
        //$this->markTestIncomplete("addAsset test not implemented");
        $arr_coach_types=array("10M2","10M5","8M2T","10M2","10M5","5M2A");
        $counter=0;
        for($i=0;$i<count($arr_coach_types);$i++){
            $this->arr_add["coachDetails2DArray"][0]["coachType"]=$arr_coach_types[$i];
            $this->assetRegisterBO->set($this->arr_add);
            $status_message=$this->assetRegister->addAsset($this->assetRegisterBO);
            if($status_message){
                $counter++;
            }
        }        
        $this->assertEquals(6,$counter);
    }

    /**
     * Tests AssetRegister->updateAsset()
     */
    public function testUpdateAsset()
    {
        // TODO Auto-generated AssetRegisterTest->testUpdateAsset()
        //$this->markTestIncomplete("updateAsset test not implemented");
        $this->assetRegisterBO->set($this->arr_update);
        $status_message=$this->assetRegister->updateAsset($this->assetRegisterBO);
        $this->assertEquals(true,$status_message);
    }

    public function testSearchAssetRegisterWhenAssetDoesExist()
    {
        // TODO Auto-generated AssetRegisterTest->testSearchAssetRegister()
        //$this->markTestIncomplete("searchAssetRegister test not implemented");
        $arr=array();        
        $arr["coachNumber"]="10M29988T";
        $this->assetRegisterBO->set($arr);
        $arr_result=$this->assetRegister->searchAssetRegister($this->assetRegisterBO);
        $this->assertEquals(3,count($arr_result));        
    }

    /**
     * Tests AssetRegister->listCoachTypes()
     */
    public function testListCoachTypes()
    {
        // TODO Auto-generated AssetRegisterTest->testListCoachTypes()
        //$this->markTestIncomplete("listCoachTypes test not implemented");        
        $arr=$this->assetRegister->listCoachTypes();
        $this->assertEquals(5,count($arr["coachDetails2DArray"]));
    }

    /**
     * Tests AssetRegister->checkAssetExists()
     */
    public function testCheckAssetExistsWhenItExists()
    {
        // TODO Auto-generated AssetRegisterTest->testCheckAssetExists()
        //$this->markTestIncomplete("checkAssetExists test not implemented");
        $arr=array();        
        $arr["coachNumber"]="10M29988T";
        $this->assetRegisterBO->set($arr);
        $status_message=$this->assetRegister->checkAssetExists($this->assetRegisterBO);
        $this->assertEquals(true,$status_message);
    }
    
    /**
     * Tests AssetRegister->readCSVFileAssetsData()
     */
    public function testReadCSVFileAssetsDataWhenHeadersMissing()
    {
        // TODO Auto-generated AssetRegisterTest->testReadCSVFileAssetsData()
        //$this->markTestIncomplete("readCSVFileAssetsData test not implemented");
        //file 305941.csv has missing headers
        $arr=array();
        $arr["staffNumber"]="305941";
        $this->assetRegisterBO->set($arr);
        $arr=$this->assetRegister->readCSVFileAssetsData($this->assetRegisterBO);
        $this->assertEquals("0x08",$arr["errorAssocArray"]["errorCode"]);
    }
    
    public function testReadCSVFileAssetsDataWhenHeadersOrderWrong()
    {
        // TODO Auto-generated AssetRegisterTest->testReadCSVFileAssetsData()
        //$this->markTestIncomplete("readCSVFileAssetsData test not implemented");
        //file 305942.csv has wrong header order
        $arr=array();
        $arr["staffNumber"]="305942";
        $this->assetRegisterBO->set($arr);
        $arr=$this->assetRegister->readCSVFileAssetsData($this->assetRegisterBO);
        $this->assertEquals("0x06",$arr["errorAssocArray"]["errorCode"]);
    }
    
    public function testReadCSVFileAssetsDataWhenDataMissing()
    {
        // TODO Auto-generated AssetRegisterTest->testReadCSVFileAssetsData()
        //$this->markTestIncomplete("readCSVFileAssetsData test not implemented");
        //file 305943.csv has missing data
        $arr=array();
        $arr["staffNumber"]="305943";
        $this->assetRegisterBO->set($arr);
        $arr=$this->assetRegister->readCSVFileAssetsData($this->assetRegisterBO);
        $this->assertEquals("0x02",$arr["errorAssocArray"]["errorCode"]);
    }
    
    public function testReadCSVFileAssetsDataWhenEverythingIsOK()
    {
        // TODO Auto-generated AssetRegisterTest->testReadCSVFileAssetsData()
        //$this->markTestIncomplete("readCSVFileAssetsData test not implemented");
        //file 305944.csv has everything OK
        $arr=array();
        $arr["staffNumber"]="305944";
        $this->assetRegisterBO->set($arr);
        $arr=$this->assetRegister->readCSVFileAssetsData($this->assetRegisterBO);
        $this->assertEquals(14,count($arr));
    }
}

