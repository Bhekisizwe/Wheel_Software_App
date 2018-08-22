<?php
use PHPUnit\Framework\TestCase;
use UserClasses\BusinessLayer\AxleCoachMapping;

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
    private $axleCoachMapping;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated AxleCoachMappingTest::setUp()
        
        $this->axleCoachMapping = new AxleCoachMapping();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated AxleCoachMappingTest::tearDown()
        $this->axleCoachMapping = null;
        
        parent::tearDown();
    }    

    /**
     * Tests AxleCoachMapping->readCSVFileMapping()
     */
    public function testReadCSVFileMappingFileWithHeadingsMissing()
    {
        // TODO Auto-generated AxleCoachMappingTest->testReadCSVFileMapping()
        $this->markTestIncomplete("readCSVFileMapping test not implemented");
        
        $this->axleCoachMapping->readCSVFileMapping(/* parameters */);
    }
    
    public function testReadCSVFileMappingFileWithHeadingsOrderWrong()
    {
        // TODO Auto-generated AxleCoachMappingTest->testReadCSVFileMapping()
        $this->markTestIncomplete("readCSVFileMapping test not implemented");
        
        $this->axleCoachMapping->readCSVFileMapping(/* parameters */);
    }
    
    public function testReadCSVFileMappingFileWithMissingData()
    {
        // TODO Auto-generated AxleCoachMappingTest->testReadCSVFileMapping()
        $this->markTestIncomplete("readCSVFileMapping test not implemented");
        
        $this->axleCoachMapping->readCSVFileMapping(/* parameters */);
    }
    
    public function testReadCSVFileMappingFileWithEverythingOK()
    {
        // TODO Auto-generated AxleCoachMappingTest->testReadCSVFileMapping()
        $this->markTestIncomplete("readCSVFileMapping test not implemented");
        
        $this->axleCoachMapping->readCSVFileMapping(/* parameters */);
    }

    /**
     * Tests AxleCoachMapping->addMapping()
     */
    public function testAddMapping()
    {
        // TODO Auto-generated AxleCoachMappingTest->testAddMapping()
        $this->markTestIncomplete("addMapping test not implemented");
        
        $this->axleCoachMapping->addMapping(/* parameters */);
    }

    /**
     * Tests AxleCoachMapping->searchMapping()
     */
    public function testSearchMapping()
    {
        // TODO Auto-generated AxleCoachMappingTest->testSearchMapping()
        $this->markTestIncomplete("searchMapping test not implemented");
        
        $this->axleCoachMapping->searchMapping(/* parameters */);
    }
}

