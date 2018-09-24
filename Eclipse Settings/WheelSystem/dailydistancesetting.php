<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UserClasses\BusinessLayer\DailyDistanceSetting;
use UserClasses\BusinessObjects\DailyDistanceSettingBO;
use UserClasses\BusinessLayer\UserRole;
use UserClasses\BusinessObjects\UserRoleBO;
use UserClasses\BusinessLayer\ManageSession;
    //View Distance Setting
    $app->get('/dailydistancesetting', function (Request $request, Response $response, array $args) {
        //Create Objects
        $distanceSettings=new DailyDistanceSetting();
        $distanceSettingsBO=new DailyDistanceSettingBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
        if(isset($_SESSION["staffNumber"])){
            $userrole_arr["userRole2DArray"][0]["roleID"]=$_SESSION["roleID"];
            $userroleBO->set($userrole_arr);
            $accessRight="R";
            $activityName="Average Distance Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $distance_settings_arr=$distanceSettings->showDistanceSetting($distanceSettingsBO);
                $distanceSettingsBO->set($distance_settings_arr);
                $distanceSettingsBO->setTransactionStatus(true);
                //$manualSettingsBO->setDataExistsStatus(true);
                $arr=$distanceSettingsBO->getArray();
            }
            else {
                $distanceSettingsBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"]=$arr_err;
                $distanceSettingsBO->set($arr_error);
                $arr=$distanceSettingsBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $distanceSettingsBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $distanceSettingsBO->set($arr_error);
            $arr=$distanceSettingsBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($distanceSettings);
        unset($distanceSettingsBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
    });
    
    //Add
    $app->post('/dailydistancesetting/add', function (Request $request, Response $response, array $args) {
        //Create Objects
        $distanceSettings=new DailyDistanceSetting();
        $distanceSettingsBO=new DailyDistanceSettingBO();
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
            $activityName="Average Distance Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $distanceSettingsBO->set($form_data);
                $distanceSettingsBO->setStaffNumber($_SESSION["staffNumber"]);
                $distanceSettingsBO->setTransactionStatus($distanceSettings->addDistanceSetting($distanceSettingsBO));
                $arr=$distanceSettingsBO->getArray();
            }
            else{
                $distanceSettingsBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"]=$arr_err;
                $distanceSettingsBO->set($arr_error);
                $arr=$distanceSettingsBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $distanceSettingsBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $distanceSettingsBO->set($arr_error);
            $arr=$distanceSettingsBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($distanceSettings);
        unset($distanceSettingsBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
        
    });
        
    //Update
    $app->post('/dailydistancesetting/update', function (Request $request, Response $response, array $args) {
        //Create Objects
        $distanceSettings=new DailyDistanceSetting();
        $distanceSettingsBO=new DailyDistanceSettingBO();
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
            $activityName="Average Distance Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $distanceSettingsBO->set($form_data);
                $distanceSettingsBO->setStaffNumber($_SESSION["staffNumber"]);
                $distanceSettingsBO->setTransactionStatus($distanceSettings->updateDistanceSetting($distanceSettingsBO));
                $arr=$distanceSettingsBO->getArray();
            }
            else{
                $distanceSettingsBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"]=$arr_err;
                $distanceSettingsBO->set($arr_error);
                $arr=$distanceSettingsBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $distanceSettingsBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $distanceSettingsBO->set($arr_error);
            $arr=$distanceSettingsBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($distanceSettings);
        unset($distanceSettingsBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
        
    });
?>
