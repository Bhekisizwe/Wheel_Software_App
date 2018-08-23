<?php
declare(strict_types=1);
namespace UserClasses\BusinessLayer;

use UserClasses\BusinessObjects\ActivityLogBO;
use UserClasses\BusinessObjects\AxlesPerCoachTypeBO;
use UserClasses\DataLayer\AxlesPerCoachTypeDL;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class AxlesPerCoachType
{
    private $activityLog;
    private $activityBO;
    private $axlesCoachDL;
    private $err;
    /**
     */
    public function __construct()
    {
        $this->err=new ErrorLog();
        $this->activityLog=new ActivityLog();
        $this->activityBO=new ActivityLogBO();
        $this->axlesCoachDL=new AxlesPerCoachTypeDL();
    }

    /**
     */
    function __destruct()
    {
        $this->err=null;
        $this->activityLog=null;
        $this->activityBO=null;
        $this->axlesCoachDL=null;
    }
    
    public function showAxleNumberSetting(AxlesPerCoachTypeBO $data):array {
        if(isset($data)){
            try {
                $arr_2D=array();
                $arr=$data->getArray();
                $arr_2D=$this->axlesCoachDL->searchData($arr);
            } catch (\Exception $e) {
                $class_name="AxlesPerCoachType";
                $method_name="showAxleNumberSetting";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $arr_2D;
        }
        else return NULL;
    }
    
    public function addAxleNumberSetting(AxlesPerCoachTypeBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $status_message=$this->axlesCoachDL->create($arr);
                if($status_message){
                    $arr_data=array();
                    $arr_data["taskArray2D"][0]["taskName"]="System Settings";
                    $arr_data["transactionName"]="Adding Axle Number Per Coach Type to Database";
                    $arr_data["activityAction"]=1;      //create
                    $arr_data["staffNumber"]=$data->getStaffNumber();
                    $this->activityBO->set($arr_data);
                    $this->activityLog->addActivityData($this->activityBO);
                }
            } catch (\Exception $e) {
                $class_name="AxlesPerCoachType";
                $method_name="addAxleNumberSetting";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $status_message;
        }
        else return false;
    }
    
    public function updateAxleNumberSetting(AxlesPerCoachTypeBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $status_message=$this->axlesCoachDL->update($arr);
                if($status_message){
                    $arr_data=array();
                    $arr_data["taskArray2D"][0]["taskName"]="System Settings";
                    $arr_data["transactionName"]="Updating Axle Number Per Coach Type to Database";
                    $arr_data["activityAction"]=2;      //update
                    $arr_data["staffNumber"]=$data->getStaffNumber();
                    $this->activityBO->set($arr_data);
                    $this->activityLog->addActivityData($this->activityBO);
                }
            } catch (\Exception $e) {
                $class_name="AxlesPerCoachType";
                $method_name="updateAxleNumberSetting";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $status_message;
        }
        else return false;
    }
}
