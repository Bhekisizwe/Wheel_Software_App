<?php
use PHPUnit\Framework\TestCase;
use UserClasses\BusinessLayer\ManualWheelSettings;
use UserClasses\BusinessObjects\ManualWheelSettingsBO;
use UserClasses\DataLayer\ManualWheelSettingsDL;

require_once 'vendor/UserClasses/BusinessLayer/src/ManualWheelSettings.php';

/**
 * ManualWheelSettings test case.
 */
class ManualWheelSettingsTest extends TestCase
{

    /**
     *
     * @var ManualWheelSettings
     */
    protected $manualWheelSettings;
    protected $data;
    protected $manualSettingsDL;
    protected $arr_add;
    protected $arr_update;
    

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated ManualWheelSettingsTest::setUp()
        
        $this->manualWheelSettings = new ManualWheelSettings();
        $this->data=new ManualWheelSettingsBO();
        $this->manualSettingsDL=new ManualWheelSettingsDL();
        $arr_add=array();
        $arr_add["staffNumber"]="305941";
        $arr_add["warning2DArray"][0]["paramID"]=5;
        $arr_add["warning2DArray"][0]["warningLevel"]="23.5";
        $arr_add["warning2DArray"][1]["paramID"]=6;
        $arr_add["warning2DArray"][1]["warningLevel"]="88.62";
        $arr_add["warning2DArray"][2]["paramID"]=7;
        $arr_add["warning2DArray"][2]["warningLevel"]="10.25";
        $arr_add["warning2DArray"][3]["paramID"]=8;
        $arr_add["warning2DArray"][3]["warningLevel"]="17.8";
        $arr_add["warning2DArray"][4]["paramID"]=9;
        $arr_add["warning2DArray"][4]["warningLevel"]="20.03";
        $this->arr_add=$arr_add;
        $arr_update=array();
        $arr_update["staffNumber"]="305941";
        $arr_update["warning2DArray"][0]["paramName"]="CTD";
        $arr_update["warning2DArray"][0]["warningLevel"]="30.78";
        $arr_update["warning2DArray"][0]["settingsID"]=1;
        $arr_update["warning2DArray"][1]["paramName"]="CTW";
        $arr_update["warning2DArray"][1]["warningLevel"]="88.62";
        $arr_update["warning2DArray"][1]["settingsID"]=2;
        $arr_update["warning2DArray"][2]["paramName"]="CTDFF";
        $arr_update["warning2DArray"][2]["warningLevel"]="10.25";
        $arr_update["warning2DArray"][2]["settingsID"]=3;
        $arr_update["warning2DArray"][3]["paramName"]="SR";
        $arr_update["warning2DArray"][3]["warningLevel"]="20";
        $arr_update["warning2DArray"][3]["settingsID"]=4;
        $arr_update["warning2DArray"][4]["paramName"]="WS";
        $arr_update["warning2DArray"][4]["warningLevel"]="25.89";
        $arr_update["warning2DArray"][4]["settingsID"]=5;
        $this->arr_update=$arr_update;
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated ManualWheelSettingsTest::tearDown()
        $this->manualWheelSettings = null;
        $this->data=null;
        $this->manualSettingsDL=null;
        parent::tearDown();
    }
    
    /**
     * Tests ManualWheelSettings->showGlobalWheelSettings()
     */
    public function testShowGlobalWheelSettingsWhenItDoesNotExist()
    {
        // TODO Auto-generated ManualWheelSettingsTest->testShowGlobalWheelSettings()
        //$this->markTestIncomplete("showGlobalWheelSettings test not implemented");
        $arr=array();
        $this->manualSettingsDL->delete($arr);       //delete everything
        $this->data->set($this->arr_add);
        $arr_result=$this->manualWheelSettings->showGlobalWheelSettings($this->data);
        $this->assertEquals(0,count($arr_result));
    }

    /**
     * Tests ManualWheelSettings->listManualWheelParameters()
     */
    public function testListManualWheelParameters()
    {
        // TODO Auto-generated ManualWheelSettingsTest->testListManualWheelParameters()
        //$this->markTestIncomplete("listManualWheelParameters test not implemented");        
        $arr=$this->manualWheelSettings->listManualWheelParameters();
        $this->assertEquals(5,count($arr["warning2DArray"]));
    }

    /**
     * Tests ManualWheelSettings->addGlobalWheelSettings()
     */
    public function testAddGlobalWheelSettings()
    {
        // TODO Auto-generated ManualWheelSettingsTest->testAddGlobalWheelSettings()
        //$this->markTestIncomplete("addGlobalWheelSettings test not implemented");
        $this->data->set($this->arr_add);
        $status_message=$this->manualWheelSettings->addGlobalWheelSettings($this->data);
        $this->assertEquals(true,$status_message);
    }
    
    public function testShowGlobalWheelSettingsWhenItDoesExist()
    {
        // TODO Auto-generated ManualWheelSettingsTest->testShowGlobalWheelSettings()
        //$this->markTestIncomplete("showGlobalWheelSettings test not implemented"); 
        $this->data->set($this->arr_add);
        $arr_result=$this->manualWheelSettings->showGlobalWheelSettings($this->data);
        $this->assertEquals(1,count($arr_result));
    }

    /**
     * Tests ManualWheelSettings->updateGlobalWheelSettings()
     */
    public function testUpdateGlobalWheelSettings()
    {
        // TODO Auto-generated ManualWheelSettingsTest->testUpdateGlobalWheelSettings()
        //$this->markTestIncomplete("updateGlobalWheelSettings test not implemented");
        $this->data->set($this->arr_update);
        $status=$this->manualWheelSettings->updateGlobalWheelSettings($this->data);
        $this->assertEquals(true,$status);
    }
}

