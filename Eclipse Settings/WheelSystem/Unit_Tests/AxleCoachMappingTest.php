<?php
use PHPUnit\Framework\TestCase;
use UserClasses\BusinessLayer\AxleCoachMapping;
use UserClasses\BusinessObjects\AxleCoachMappingBO;
use UserClasses\DataLayer\AxleCoachMappingDL;

require_once 'vendor/UserClasses/BusinessLayer/src/AxleCoachMapping.php';

/**
 * AxleCoachMapping test case.
 */
class AxleCoachMappingTest extends TestCase
{

    /**
     *
     * @var AxleCoachMapping
     */
    protected $axleCoachMapping;
    protected $axleBO;
    protected $axleDL;
    protected $arr_add;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated AxleCoachMappingTest::setUp()
        
        $this->axleCoachMapping = new AxleCoachMapping();        
        $this->axleBO=new AxleCoachMappingBO();
        $this->axleDL=new AxleCoachMappingDL();
        $arr_add=array();
        $arr_add["axleSerialNumber"]="10M2AR2";
        $arr_add["axleNumber"]="2";
        $arr_add["setNumber"]="M4";
        $arr_add["coachNumber"]="10M51008";
        $this->arr_add=$arr_add;
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated AxleCoachMappingTest::tearDown()
        $this->axleCoachMapping = null;
        $this->axleBO=null;
        $this->axleDL=null;
        parent::tearDown();
    }    

    /**
     * Tests AxleCoachMapping->readCSVFileMapping()
     */
    public function testReadCSVFileMappingFileWithHeadingsMissing()
    {
        // TODO Auto-generated AxleCoachMappingTest->testReadCSVFileMapping()
        //$this->markTestIncomplete("readCSVFileMapping test not implemented");
        $arr=array();
        $arr["staffNumber"]="305941";
        $this->axleBO->set($arr);
        $arr_result=$this->axleCoachMapping->readCSVFileMapping($this->axleBO);
        $this->assertEquals("0x09",$arr_result["errorAssocArray"]["errorCode"]);
    }
    
    public function testReadCSVFileMappingFileWithHeadingsOrderWrong()
    {
        // TODO Auto-generated AxleCoachMappingTest->testReadCSVFileMapping()
        //$this->markTestIncomplete("readCSVFileMapping test not implemented");
        $arr=array();
        $arr["staffNumber"]="305942";
        $this->axleBO->set($arr);
        $arr_result=$this->axleCoachMapping->readCSVFileMapping($this->axleBO);
        $this->assertEquals("0x11",$arr_result["errorAssocArray"]["errorCode"]);
    }
    
    public function testReadCSVFileMappingFileWithMissingData()
    {
        // TODO Auto-generated AxleCoachMappingTest->testReadCSVFileMapping()
        //$this->markTestIncomplete("readCSVFileMapping test not implemented");
        $arr=array();
        $arr["staffNumber"]="305943";
        $this->axleBO->set($arr);
        $arr_result=$this->axleCoachMapping->readCSVFileMapping($this->axleBO);
        $this->assertEquals("0x03",$arr_result["errorAssocArray"]["errorCode"]);
    }
    
    public function testReadCSVFileMappingFileWithEverythingOK()
    {
        // TODO Auto-generated AxleCoachMappingTest->testReadCSVFileMapping()
        //$this->markTestIncomplete("readCSVFileMapping test not implemented");
        $arr=array();
        $arr["staffNumber"]="305944";
        $this->axleBO->set($arr);
        $arr_result=$this->axleCoachMapping->readCSVFileMapping($this->axleBO);
        $this->assertEquals(12,count($arr_result));
    }

    /**
     * Tests AxleCoachMapping->addMapping()
     */
    public function testAddMapping()
    {
        // TODO Auto-generated AxleCoachMappingTest->testAddMapping()
        //$this->markTestIncomplete("addMapping test not implemented");        
        $arr=array();
        $this->axleDL->delete($arr);    //delete everything in Table AxleCoachMapping
        $this->axleBO->set($this->arr_add);
        $status=$this->axleCoachMapping->addMapping($this->axleBO);
        $this->assertEquals(true,$status);
    }

    /**
     * Tests AxleCoachMapping->searchMapping()
     */
    public function testSearchMapping()
    {
        // TODO Auto-generated AxleCoachMappingTest->testSearchMapping()
        //$this->markTestIncomplete("searchMapping test not implemented");
        $arr=array();
        $arr["axleSerialNumber"]="10M2AR2";
        $arr["startDate"]="2018-08-20";
        $arr["endDate"]="2018-11-22";
        $this->axleBO->set($arr);
        $arr_result=$this->axleCoachMapping->searchMapping($this->axleBO);
        $this->assertEquals(1,count($arr_result));
    }
}

