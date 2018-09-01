<?php
declare(strict_types=1);
namespace UserClasses\BusinessLayer;

use UserClasses\DataLayer\WheelReprofilingDL;
use UserClasses\BusinessObjects\ActivityLogBO;
use UserClasses\BusinessObjects\WheelReprofilingDataBO;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class WheelReprofilingData
{
    private $activityLog;
    private $activityBO;
    private $wheelReprofDL;
    private $err;

    /**
     */
    public function __construct()
    {
        $this->err=new ErrorLog();
        $this->activityLog=new ActivityLog();
        $this->activityBO=new ActivityLogBO();
        $this->wheelReprofDL=new WheelReprofilingDL();
    }

    /**
     */
    function __destruct()
    {
        $this->err=null;
        $this->activityBO=null;
        $this->activityLog=null;
        $this->wheelReprofDL=null;
    }
    
    public function searchForReprofilingData(WheelReprofilingDataBO $data):array {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $arr_result=$this->wheelReprofDL->searchData($arr);
                for($i=0;$i<count($arr_result);$i++){
                    //if there are results returned from the database, then compute cutLength
                    $arr_result[$i]["leftWheelCutLength"]=$this->calculateCutLength($arr_result[$i]["initialLeftDiameter"],$arr_result[$i]["finalLeftDiameter"]);
                    $arr_result[$i]["rightWheelCutLength"]=$this->calculateCutLength($arr_result[$i]["initialRightDiameter"],$arr_result[$i]["finalRightDiameter"]);
                }
            } catch (\Exception $e) {
                $class_name="WheelReprofilingData";
                $method_name="searchForReprofilingData";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }            
            return $arr_result;
        }
        else return NULL;
    }
    
    public function addReprofilingData(WheelReprofilingDataBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();                  
                $status_message=$this->wheelReprofDL->create($arr);
                if($status_message){
                    $arr_data=array();
                    $arr_data["taskArray2D"][0]["taskName"]="Re-profiling data";
                    $arr_data["transactionName"]="Adding Wheel Reprofiling Data to Database";
                    $arr_data["activityAction"]=1;      //create
                    $arr_data["staffNumber"]=$data->getStaffNumber();
                    $this->activityBO->set($arr_data);
                    $this->activityLog->addActivityData($this->activityBO);
                }                
            } catch (\Exception $e) {
                $class_name="WheelReprofilingData";
                $method_name="addReprofilingData";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $status_message;
        }
        else return false;
    }
    
    public function updateReprofilingData(WheelReprofilingDataBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $status_message=$this->wheelReprofDL->update($arr);
                if($status_message){
                    $arr_data=array();
                    $arr_data["taskArray2D"][0]["taskName"]="Re-profiling data";
                    $arr_data["transactionName"]="Updating Wheel Reprofiling Data in Database";
                    $arr_data["activityAction"]=2;      //update
                    $arr_data["staffNumber"]=$data->getStaffNumber();
                    $this->activityBO->set($arr_data);
                    $this->activityLog->addActivityData($this->activityBO);
                }
            } catch (\Exception $e) {
                $class_name="WheelReprofilingData";
                $method_name="updateReprofilingData";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $status_message;
        }
        else return false;
    }
    
    public function checkReprofilingDataExists(WheelReprofilingDataBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $status_message=$this->wheelReprofDL->dataExists($arr);
            } catch (\Exception $e) {
                $class_name="WheelReprofilingData";
                $method_name="checkReprofilingDataExists";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            
            return $status_message;
        }
        else return false;
    }
    
    private function calculateCutLength(float $initialDiameter,float $finalDiameter):float {
        $cutLength=round($initialDiameter-$finalDiameter,2);    //round off to 2 decimal places
        if($cutLength>0){
            //then it means wheel cutting did happen. Else re-tyring happened and not cutting
            return $cutLength;
        }
        else return 0.0;    //retyring happened here and not cutting.
    }
}

