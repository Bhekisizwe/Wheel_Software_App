<?php
declare(strict_types=1);
namespace UserClasses\BusinessLayer;

use UserClasses\BusinessObjects\ActivityLogBO;
use UserClasses\DataLayer\WearRatesDL;
use UserClasses\BusinessObjects\WearRatesBO;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class WearRatesSetting
{
    private $err;
    private $activityLog;
    private $activityBO;
    private $wearRatesDL;

    /**
     */
    public function __construct()
    {
        $this->err=new ErrorLog();
        $this->activityLog=new ActivityLog();
        $this->activityBO=new ActivityLogBO();
        $this->wearRatesDL=new WearRatesDL();
    }

    /**
     */
    function __destruct()
    {
        $this->err=null;
        $this->activityLog=null;
        $this->activityBO=null;
        $this->wearRatesDL=null;
    }
    
    public function showWearRateSettings(WearRatesBO $data):array {
        if(isset($data)){
            try {
                $arr_2D=array();
                $arr=$data->getArray();
                $arr_2D=$this->wearRatesDL->searchData($arr);
            } catch (\Exception $e) {
                $class_name="WearRatesSetting";
                $method_name="showWearRateSettings";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $arr_2D;
        }
        else return NULL;
    }
    
    public function addWearRateSettings(WearRatesBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $status_message=$this->wearRatesDL->create($arr);
                if($status_message){
                    $arr_data=array();
                    $arr_data["taskArray2D"][0]["taskName"]="System Settings";
                    $arr_data["transactionName"]="Adding Wear Rate Settings to Database";
                    $arr_data["activityAction"]=1;      //create
                    $arr_data["staffNumber"]=$data->getStaffNumber();
                    $this->activityBO->set($arr_data);
                    $this->activityLog->addActivityData($this->activityBO);
                }
            } catch (\Exception $e) {
                $class_name="WearRatesSetting";
                $method_name="addWearRateSettings";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $status_message;
        }
        else return false;
    }
    
    public function updateWearRateSettings(WearRatesBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $status_message=$this->wearRatesDL->update($arr);
                if($status_message){
                    $arr_data=array();
                    $arr_data["taskArray2D"][0]["taskName"]="System Settings";
                    $arr_data["transactionName"]="Updating Wear Rate Settings in Database";
                    $arr_data["activityAction"]=2;      //update
                    $arr_data["staffNumber"]=$data->getStaffNumber();
                    $this->activityBO->set($arr_data);
                    $this->activityLog->addActivityData($this->activityBO);
                }
            } catch (\Exception $e) {
                $class_name="WearRatesSetting";
                $method_name="updateWearRateSettings";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $status_message;
        }
        else return false;
    }
    
    public function listWearRateParameters():array {        
        try {
            $arr=$this->wearRatesDL->retrieveAllParameters();
        } catch (\Exception $e) {
            $class_name="WearRatesSetting";
            $method_name="listWearRateParameters";
            $this->err->logErrors($e,null,$class_name, $method_name);
        }
        return $arr;
    }
}

