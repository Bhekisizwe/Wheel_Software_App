<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UserClasses\BusinessLayer\ManualWheelMeasurements;
use UserClasses\BusinessObjects\ManualWheelMeasurementsBO;
use UserClasses\BusinessLayer\UserRole;
use UserClasses\BusinessObjects\UserRoleBO;
use UserClasses\BusinessLayer\MiniProfDBUploader;
use UserClasses\BusinessObjects\MiniProfMeasurementsBO;
    //View Specific MiniProf Wheel Data
    $app->get('/manualmeasurements/miniprof/{coachnumber_wheelid_date}', function (Request $request, Response $response, array $args) {
        //Create Objects
        $miniWheel=new MiniProfDBUploader();
        $miniWheelBO=new MiniProfMeasurementsBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        $mini_meas_str=$args["coachnumber_wheelid_date"];
        $mini_meas_arr=explode("_",$mini_meas_str);
        $arr=$miniWheelBO->getArray();
        if(isset($_SESSION["staffNumber"])){
            $userrole_arr["userRole2DArray"][0]["roleID"]=$_SESSION["roleID"];
            $userroleBO->set($userrole_arr);
            $accessRight="R";
            $activityName="Wheel Measurements Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $arr=array();
                $mini["measurementDate"]=$mini_meas_arr[2];
                $mini["wheelID"]=$mini_meas_arr[1];
                $mini["coachNumber"]=$mini_meas_arr[0];
                $miniWheelBO->set($mini);
                $mini_arr=$miniWheel->showSpecificWheelData($miniWheelBO);
                for($i=0;$i<count($mini_arr);$i++){
                    $miniWheelBO->set($mini_arr[$i]);
                    $miniWheelBO->setTransactionStatus(true);
                    $arr[]=$miniWheelBO->getArray();
                }                
            }
            else {
                $miniWheelBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"][18]=$arr_err;
                $miniWheelBO->set($arr_error);
                $arr=$miniWheelBO->getArray();
            }
        }
        else{
            $miniWheelBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $miniWheelBO->set($arr_error);
            $arr=$miniWheelBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($miniWheel);
        unset($miniWheelBO);
        unset($userrole);
        unset($userroleBO);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //View Manual Wheel Data
    $app->get('/manualmeasurements/{measurementid}', function (Request $request, Response $response, array $args) {
        //Create Objects
        $manualWheel=new ManualWheelMeasurements();
        $manualWheelBO=new ManualWheelMeasurementsBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        $measurementID=$args["measurementid"];
        $arr=$manualWheelBO->getArray();
        if(isset($_SESSION["staffNumber"])){
            $userrole_arr["userRole2DArray"][0]["roleID"]=$_SESSION["roleID"];
            $userroleBO->set($userrole_arr);
            $accessRight="R";
            $activityName="Wheel Measurements Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $arr=array();
                $manual["measurementID"]=$measurementID;
                $manualWheelBO->set($manual);
                $manual_arr=$manualWheel->showManualWheelData($manualWheelBO);
                for($i=0;$i<count($manual_arr);$i++){
                    $manualWheelBO->set($manual_arr[$i]);
                    $manualWheelBO->setTransactionStatus(true);
                    $arr[]=$manualWheelBO->getArray();
                }                
                //$manualSettingsBO->setDataExistsStatus(true);
                $arr=$manualWheelBO->getArray();
            }
            else {
                $manualWheelBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"][18]=$arr_err;
                $manualWheelBO->set($arr_error);
                $arr=$manualWheelBO->getArray();
            }
        }
        else{
            $manualWheelBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $manualWheelBO->set($arr_error);
            $arr=$manualWheelBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manualWheel);
        unset($manualWheelBO);
        unset($userrole);
        unset($userroleBO);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });            
    
    //Add
    $app->post('/manualmeasurements/add', function (Request $request, Response $response, array $args) {
        //Create Objects
        $manualWheel=new ManualWheelMeasurements();
        $manualWheelBO=new ManualWheelMeasurementsBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        //Return Associative Array
        $form_data=json_decode($request->getBody()->getContents(),TRUE);  //get client form data
        if(isset($_SESSION["staffNumber"])){
            $userrole_arr["userRole2DArray"][0]["roleID"]=$_SESSION["roleID"];
            $userroleBO->set($userrole_arr);
            $accessRight="C";
            $activityName="Wheel Measurements Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $manualWheelBO->set($form_data);
                $manualWheelBO->setStaffNumber($_SESSION["staffNumber"]);
                $manualWheelBO->setTransactionStatus($manualWheel->addManualWheelMeasurements($manualWheelBO));
                $arr=$manualWheelBO->getArray();
            }
            else{
                $manualWheelBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"][18]=$arr_err;
                $manualWheelBO->set($arr_error);
                $arr=$manualWheelBO->getArray();
            }
        }
        else{
            $manualWheelBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $manualWheelBO->set($arr_error);
            $arr=$manualWheelBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manualWheel);
        unset($manualWheelBO);
        unset($userrole);
        unset($userroleBO);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
        
    //Update
    $app->post('/manualmeasurements/update', function (Request $request, Response $response, array $args) {
        //Create Objects
        $manualWheel=new ManualWheelMeasurements();
        $manualWheelBO=new ManualWheelMeasurementsBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        //Return Associative Array
        $form_data=json_decode($request->getBody()->getContents(),TRUE);  //get client form data
        if(isset($_SESSION["staffNumber"])){
            $userrole_arr["userRole2DArray"][0]["roleID"]=$_SESSION["roleID"];
            $userroleBO->set($userrole_arr);
            $accessRight="U";
            $activityName="Wheel Measurements Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $manualWheelBO->set($form_data);
                $manualWheelBO->setStaffNumber($_SESSION["staffNumber"]);
                $manualWheelBO->setTransactionStatus($manualWheel->updateManualWheelData($manualWheelBO));
                $arr=$manualWheelBO->getArray();
            }
            else{
                $manualWheelBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"][18]=$arr_err;
                $manualWheelBO->set($arr_error);
                $arr=$manualWheelBO->getArray();
            }
        }
        else{
            $manualWheelBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $manualWheelBO->set($arr_error);
            $arr=$manualWheelBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manualWheel);
        unset($manualWheelBO);
        unset($userrole);
        unset($userroleBO);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
?>
