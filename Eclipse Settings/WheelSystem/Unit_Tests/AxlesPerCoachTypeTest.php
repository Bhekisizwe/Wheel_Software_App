<?php
use PHPUnit\Framework\TestCase;
use UserClasses\BusinessLayer\AxlesPerCoachType;
use UserClasses\BusinessObjects\AxlesPerCoachTypeBO;
use UserClasses\DataLayer\AxlesPerCoachTypeDL;

require_once 'vendor/UserClasses/BusinessLayer/src/AxlesPerCoachType.php';

/**
 * AxlesPerCoachType test case.
 */
class AxlesPerCoachTypeTest extends TestCase
{

    /**
     *
     * @var AxlesPerCoachType
     */
    protected $axlesPerCoachType; 
    protected $data;
    protected $arr_update;
    protected $axlesCoachDL;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated AxlesPerCoachTypeTest::setUp()        
        $this->axlesPerCoachType = new AxlesPerCoachType(); 
        $this->axlesCoachDL=new AxlesPerCoachTypeDL();
        $this->data=new AxlesPerCoachTypeBO();
        $arr_update=array();
        $arr_update["coachID"]=2;
        $arr_update["numberOfAxles"]=4;
        $arr_update["staffNumber"]="305941";
        $this->arr_update=$arr_update;
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated AxlesPerCoachTypeTest::tearDown()
        $this->axlesPerCoachType = null;
        $this->data=null;
        $this->axlesCoachDL=null;
        parent::tearDown();
    }  

    /**
     * Tests AxlesPerCoachType->showAxleNumberSetting()
     */
    public function testShowAxleNumberSettingWhenItDoesNotExist()
    {
        // TODO Auto-generated AxlesPerCoachTypeTest->testShowAxleNumberSetting()
        //$this->markTestIncomplete("showAxleNumberSetting test not implemented");        
        $arr=array();
        $this->axlesCoachDL->delete($arr);
        $arr["coachID"]=3;
        $this->data->set($arr);
        $arr_result=$this->axlesPerCoachType->showAxleNumberSetting($this->data);
        $this->assertEquals(0,count($arr_result));
    }

    /**
     * Tests AxlesPerCoachType->addAxleNumberSetting()
     */
    public function testAddAxleNumberSetting()
    {
        // TODO Auto-generated AxlesPerCoachTypeTest->testAddAxleNumberSetting()
        //$this->markTestIncomplete("addAxleNumberSetting test not implemented");
        $coachID=1;
        $arr=array();
        $counter=0;
        while($coachID<5){
            $arr["coachID"]=$coachID;
            $arr["numberOfAxles"]=2;
            $arr["staffNumber"]="305941";
            $this->data->set($arr);
            $status=$this->axlesPerCoachType->addAxleNumberSetting($this->data);
            if($status){
                $counter++;
            }
            $coachID++;
        }
        $this->assertEquals(4,$counter);
    }
    
    public function testShowAxleNumberSettingWhenItDoesExist()
    {
        // TODO Auto-generated AxlesPerCoachTypeTest->testShowAxleNumberSetting()
        //$this->markTestIncomplete("showAxleNumberSetting test not implemented");
        $arr=array();
        $arr["coachID"]=3;
        $this->data->set($arr);
        $arr_result=$this->axlesPerCoachType->showAxleNumberSetting($this->data);
        $this->assertEquals(2,count($arr_result));
    }

    /**
     * Tests AxlesPerCoachType->updateAxleNumberSetting()
     */
    public function testUpdateAxleNumberSetting()
    {
        // TODO Auto-generated AxlesPerCoachTypeTest->testUpdateAxleNumberSetting()
        //$this->markTestIncomplete("updateAxleNumberSetting test not implemented");
        $this->data->set($this->arr_update);
        $status=$this->axlesPerCoachType->updateAxleNumberSetting($this->data);
        $this->assertEquals(true,$status);
    }
}

