<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UserClasses\BusinessLayer\ManualWheelMeasurements;
use UserClasses\BusinessObjects\ManualWheelMeasurementsBO;
use UserClasses\BusinessLayer\UserRole;
use UserClasses\BusinessObjects\UserRoleBO;
use UserClasses\BusinessLayer\MiniProfDBUploader;
use UserClasses\BusinessObjects\MiniProfMeasurementsBO;
use UserClasses\BusinessLayer\ManageSession;
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
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
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
                if(count($mini_arr)==0){
                    $arr[0]["transactionStatus"]=true;
                    $arr[0]["setNumber"]="";
                    $arr[0]["axleNumber"]=0;
                    $arr[0]["coachNumber"]="";
                    $arr[0]["wheelID"]=0;
                    $arr[0]["operatorName"]="";
                    $arr[0]["measurementDate"]="";
                    $arr[0]["measurementTime"]="";
                    $arr[0]["measurementID"]=0;
                } 
            }
            else {
                $miniWheelBO->setTransactionStatus(false);
                $arr=array();
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"]=$arr_err;
                $miniWheelBO->set($arr_error);
                $arr[]=$miniWheelBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $miniWheelBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr=array();
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $miniWheelBO->set($arr_error);
            $arr[]=$miniWheelBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($miniWheel);
        unset($miniWheelBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
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
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
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
                    $arr[]=$manualWheelBO->getArray();
                }  
                $manualWheelBO->setTransactionStatus(true);
                //$manualSettingsBO->setDataExistsStatus(true);
                $arr=$manualWheelBO->getArray();
            }
            else {
                $manualWheelBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"]=$arr_err;
                $manualWheelBO->set($arr_error);
                $arr=$manualWheelBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $manualWheelBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $manualWheelBO->set($arr_error);
            $arr=$manualWheelBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($manualWheel);
        unset($manualWheelBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
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
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
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
                $arr_error["errorAssocArray"]=$arr_err;
                $manualWheelBO->set($arr_error);
                $arr=$manualWheelBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $manualWheelBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $manualWheelBO->set($arr_error);
            $arr=$manualWheelBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($manualWheel);
        unset($manualWheelBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
        
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
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
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
                $arr_error["errorAssocArray"]=$arr_err;
                $manualWheelBO->set($arr_error);
                $arr=$manualWheelBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $manualWheelBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $manualWheelBO->set($arr_error);
            $arr=$manualWheelBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($manualWheel);
        unset($manualWheelBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
        
    });
?>
