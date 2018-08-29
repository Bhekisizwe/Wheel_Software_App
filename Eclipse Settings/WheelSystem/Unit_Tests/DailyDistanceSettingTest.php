<?php
use PHPUnit\Framework\TestCase;
use UserClasses\BusinessLayer\DailyDistanceSetting;
use UserClasses\DataLayer\DailyDistanceSettingDL;
use UserClasses\BusinessObjects\DailyDistanceSettingBO;

require_once 'vendor/UserClasses/BusinessLayer/src/DailyDistanceSetting.php';

/**
 * DailyDistanceSetting test case.
 */
class DailyDistanceSettingTest extends TestCase
{
    
    /**
     *
     * @var DailyDistanceSetting
     */
    protected $dailyDistanceSetting;
    protected $dailyDistanceDL;
    protected $dailyDistanceBO;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated DailyDistanceSettingTest::setUp()
        
        $this->dailyDistanceSetting = new DailyDistanceSetting();
        $this->dailyDistanceDL=new DailyDistanceSettingDL();
        $this->dailyDistanceBO=new DailyDistanceSettingBO();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated DailyDistanceSettingTest::tearDown()
        $this->dailyDistanceSetting = null;
        $this->dailyDistanceDL=null;
        $this->dailyDistanceBO=null;
        parent::tearDown();
    }

    /**
     * Tests DailyDistanceSetting->showDistanceSetting()
     */
    public function testShowDistanceSettingWhenItDoesNotExist()
    {
        // TODO Auto-generated DailyDistanceSettingTest->testShowDistanceSetting()
        //$this->markTestIncomplete("showDistanceSetting test not implemented");
        $arr=array();
        $this->dailyDistanceDL->delete($arr);       //make sure we delete everything in the database Table
        $arr_result=$this->dailyDistanceSetting->showDistanceSetting($this->dailyDistanceBO);
        $this->assertEquals(0,count($arr_result));
    }

    /**
     * Tests DailyDistanceSetting->addDistanceSetting()
     */
    public function testAddDistanceSetting()
    {
        // TODO Auto-generated DailyDistanceSettingTest->testAddDistanceSetting()
        //$this->markTestIncomplete("addDistanceSetting test not implemented");
        $arr=array();
        $arr["distance"]=10500.12;      //in kilometers
        $arr["staffNumber"]="305941";
        $this->dailyDistanceBO->set($arr);
        $status_message=$this->dailyDistanceSetting->addDistanceSetting($this->dailyDistanceBO);
        $this->assertEquals(true,$status_message);
    }
    
    public function testShowDistanceSettingWhenItDoesExist()
    {
        // TODO Auto-generated DailyDistanceSettingTest->testShowDistanceSetting()
        //$this->markTestIncomplete("showDistanceSetting test not implemented");
        $arr_result=$this->dailyDistanceSetting->showDistanceSetting($this->dailyDistanceBO);
        $this->assertEquals(2,count($arr_result));
    }

    /**
     * Tests DailyDistanceSetting->updateDistanceSetting()
     */
    public function testUpdateDistanceSetting()
    {
        // TODO Auto-generated DailyDistanceSettingTest->testUpdateDistanceSetting()
        //$this->markTestIncomplete("updateDistanceSetting test not implemented");
        $arr=array();
        $arr["distance"]=8192.23;      //in kilometers
        $arr["distanceID"]=1;
        $arr["staffNumber"]="305941";
        $this->dailyDistanceBO->set($arr);
        $status_message=$this->dailyDistanceSetting->updateDistanceSetting($this->dailyDistanceBO);
        $this->assertEquals(true,$status_message);        
    }
}

