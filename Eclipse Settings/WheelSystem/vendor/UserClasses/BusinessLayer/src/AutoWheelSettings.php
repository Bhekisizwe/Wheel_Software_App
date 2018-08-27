<?php
declare(strict_types=1);
namespace UserClasses\BusinessLayer;

use UserClasses\DataLayer\WheelAlarmSettingsDL;
use UserClasses\BusinessObjects\AutoWheelSettingsBO;
use UserClasses\BusinessObjects\ActivityLogBO;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class AutoWheelSettings
{
    private $err;
    private $activityLog;
    private $activityBO;
    private $autoSettingsDL;

    /**
     */
    public function __construct()
    {
        $this->err=new ErrorLog();
        $this->activityLog=new ActivityLog();
        $this->activityBO=new ActivityLogBO();
        $this->autoSettingsDL=new WheelAlarmSettingsDL();
    }

    /**
     */
    function __destruct()
    {
        $this->err=null;
        $this->activityLog=null;
        $this->activityBO=null;
        $this->autoSettingsDL=null;
    }
    
    public function showCoachWheelSettings(AutoWheelSettingsBO $data):array {
        if(isset($data)){
            try {
                $arr_2D=array();
                $arr=$data->getArray();
                $arr_2D=$this->autoSettingsDL->searchData($arr);
            } catch (\Exception $e) {
                $class_name="AutoWheelSettings";
                $method_name="showCoachWheelSettings";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $arr_2D;
        }
        else return NULL;
    }
    
    public function listAutoWheelParameters():array {
        try {
            $arr=$this->autoSettingsDL->retrieveAllParameters();
        } catch (\Exception $e) {
            $class_name="AutoWheelSettings";
            $method_name="listAutoWheelParameters";
            $this->err->logErrors($e,null,$class_name, $method_name);
        }
        return $arr;
    }
    
    public function addCoachWheelSettings(AutoWheelSettingsBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $status_message=$this->autoSettingsDL->create($arr);
                if($status_message){
                    $arr_data=array();
                    $arr_data["taskArray2D"][0]["taskName"]="System Settings";
                    $arr_data["transactionName"]="Adding MiniProf Wheel Measurements Settings to Database";
                    $arr_data["activityAction"]=1;      //create
                    $arr_data["staffNumber"]=$data->getStaffNumber();
                    $this->activityBO->set($arr_data);
                    $this->activityLog->addActivityData($this->activityBO);
                }
            } catch (\Exception $e) {
                $class_name="AutoWheelSettings";
                $method_name="addCoachWheelSettings";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $status_message;
        }
        else return false;
    }
    
    public function updateCoachWheelSettings(AutoWheelSettingsBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $status_message=$this->autoSettingsDL->update($arr);
                if($status_message){
                    $arr_data=array();
                    $arr_data["taskArray2D"][0]["taskName"]="System Settings";
                    $arr_data["transactionName"]="Updating MiniProf Wheel Measurements Settings in Database";
                    $arr_data["activityAction"]=2;      //update
                    $arr_data["staffNumber"]=$data->getStaffNumber();
                    $this->activityBO->set($arr_data);
                    $this->activityLog->addActivityData($this->activityBO);
                }
            } catch (\Exception $e) {
                $class_name="AutoWheelSettings";
                $method_name="updateCoachWheelSettings";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $status_message;
        }
        else return false;
    }
}

