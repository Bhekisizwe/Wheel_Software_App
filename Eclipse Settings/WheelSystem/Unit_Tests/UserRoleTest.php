<?php
use PHPUnit\Framework\TestCase;
use UserClasses\BusinessLayer\UserRole;
use UserClasses\BusinessObjects\UserRoleBO;

require_once 'vendor/UserClasses/BusinessLayer/src/UserRole.php';

/**
 * UserRole test case.
 */
class UserRoleTest extends TestCase
{

    /**
     *
     * @var UserRole
     */
    private $userRole;
    private $data;
    private $arr_add;
    private $arr_update;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated UserRoleTest::setUp()
        
        $this->userRole = new UserRole();
        $this->data=new UserRoleBO();
        $arr_add=array();
        $arr_add["userRole2DArray"]=[0=>["userRoleName"=>"Baby"]];
        $arr_add["activityRights2DArray"]=[0=>["activityID"=>1,"activityRights"=>"C R"],
            1=>["activityID"=>2,"activityRights"=>"C R U D"],
            2=>["activityID"=>3,"activityRights"=>"R"]];
        $arr_add["columnVisibility2DArray"]=[0=>["columnID"=>1,"columnVisibility"=>0],
            1=>["columnID"=>2,"columnVisibility"=>1]];
        $this->arr_add=$arr_add;
        $arr_update=array();
        //$arr_update["userRole2DArray"]=[0=>["roleID"=>2]];        
        $arr_update["activityRights2DArray"]=[0=>["accessID"=>56,"activityRights"=>"R"],
            1=>["accessID"=>57,"activityRights"=>"R"],
            2=>["accessID"=>58,"activityRights"=>"C"]];
        $arr_update["columnVisibility2DArray"]=[0=>["planningID"=>24,"columnVisibility"=>1],
            1=>["planningID"=>25,"columnVisibility"=>0]];
        $this->arr_update=$arr_update;        
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated UserRoleTest::tearDown()
        $this->userRole = null;
        $this->data=null;
        
        parent::tearDown();
    }

    /**
     * Tests UserRole->listAllUserRoles()
     */
    public function testListAllUserRoles()
    {
        // TODO Auto-generated UserRoleTest->testListAllUserRoles()
        //$this->markTestIncomplete("listAllUserRoles test not implemented");        
        $arr=$this->userRole->listAllUserRoles();
        (count($arr["userRole2DArray"])>=2)?$status=true:$status=false;
        $this->assertEquals(true,$status);
    }
    
    public function testListAllActivities()
    {
        // TODO Auto-generated UserRoleTest->testListAllUserRoles()
        //$this->markTestIncomplete("listAllActivities test not implemented");        
        $arr=$this->userRole->listAllActivities();
        $this->assertEquals(11,count($arr["activityRights2DArray"]));
    }
    
    public function testListAllColumns()
    {
        // TODO Auto-generated UserRoleTest->testListAllUserRoles()
        //$this->markTestIncomplete("listAllColumns test not implemented");        
        $arr=$this->userRole->listAllColumns();
        $this->assertEquals(8,count($arr["columnVisibility2DArray"]));
    }

    /**
     * Tests UserRole->listUserAccessRights()
     */
    public function testListUserAccessRights()
    {
        // TODO Auto-generated UserRoleTest->testListUserAccessRights()
        //$this->markTestIncomplete("listUserAccessRights test not implemented");
        $arr_2D=array();
        $arr_2D["userRole2DArray"][0]["roleID"]=2;
        $this->data->set($arr_2D);
        $arr=$this->userRole->listUserAccessRights($this->data);
        $this->assertEquals(11,count($arr["activityRights2DArray"]));
    }

    /**
     * Tests UserRole->checkUserRoleExists()
     */
    public function testCheckUserRoleExists()
    {
        // TODO Auto-generated UserRoleTest->testCheckUserRoleExists()
        //$this->markTestIncomplete("checkUserRoleExists test not implemented");
        $arr_2D=array();
        $arr_2D["userRole2DArray"][0]["userRoleName"]="admin";
        $this->data->set($arr_2D);
        $status_message=$this->userRole->checkUserRoleExists($this->data);
        $this->assertEquals(true,$status_message);
    }

    /**
     * Tests UserRole->addUserRole()
     */
    public function testAddUserRole()
    {
        // TODO Auto-generated UserRoleTest->testAddUserRole()
        //$this->markTestIncomplete("addUserRole test not implemented");
        $this->data->set($this->arr_add);
        $status=$this->userRole->addUserRole($this->data);
        $this->assertEquals(true,$status);
    }

    /**
     * Tests UserRole->updateUserRole()
     */
    public function testUpdateUserRole()
    {
        // TODO Auto-generated UserRoleTest->testUpdateUserRole()
        //$this->markTestIncomplete("updateUserRole test not implemented");
        $this->data->set($this->arr_update);
        $status=$this->userRole->updateUserRole($this->data);
        $this->assertEquals(true,$status);
    }

    /**
     * Tests UserRole->checkUserAuthorization()
     */
    public function testCheckUserAuthorizationWhenAllowed()
    {
        // TODO Auto-generated UserRoleTest->testCheckUserAuthorization()
        //$this->markTestIncomplete("checkUserAuthorization test not implemented");
        $accessRight="R";
        $activityName="MiniProf Wheel Alarm Settings";
        $arr=array();
        $arr["userRole2DArray"][0]["roleID"]=15;
        $this->data->set($arr);
        $status=$this->userRole->checkUserAuthorization($this->data,$accessRight,$activityName);
        $this->assertEquals(true,$status);
    }
    
    public function testCheckUserAuthorizationWhenNotAllowed()
    {
        // TODO Auto-generated UserRoleTest->testCheckUserAuthorization()
        //$this->markTestIncomplete("checkUserAuthorization test not implemented");
        $accessRight="C";
        $activityName="MiniProf Wheel Alarm Settings";
        $arr=array();
        $arr["userRole2DArray"][0]["roleID"]=15;
        $this->data->set($arr);
        $status=$this->userRole->checkUserAuthorization($this->data,$accessRight,$activityName);
        $this->assertEquals(false,$status);
    }
}

