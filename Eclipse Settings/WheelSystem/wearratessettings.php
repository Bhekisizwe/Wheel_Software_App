<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UserClasses\BusinessLayer\WearRatesSetting;
use UserClasses\BusinessObjects\WearRatesBO;
use UserClasses\BusinessLayer\UserRole;
use UserClasses\BusinessObjects\UserRoleBO;
use UserClasses\BusinessLayer\ManageSession;
    //View All Wear Rate Settings
    $app->get('/wearratessettings', function (Request $request, Response $response, array $args) {
        //Create Objects
        $wearSettings=new WearRatesSetting();
        $wearSettingsBO=new WearRatesBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
        if(isset($_SESSION["staffNumber"])){
            $userrole_arr["userRole2DArray"][0]["roleID"]=$_SESSION["roleID"];
            $userroleBO->set($userrole_arr);
            $accessRight="R";
            $activityName="Average Wear Rates Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $wear_settings_arr=$wearSettings->showWearRateSettings($wearSettingsBO);
                $wearSettingsBO->set($wear_settings_arr);
                $wearSettingsBO->setTransactionStatus(true);
                //$manualSettingsBO->setDataExistsStatus(true);
                $arr=$wearSettingsBO->getArray();
            }
            else {
                $wearSettingsBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"]=$arr_err;
                $wearSettingsBO->set($arr_error);
                $arr=$wearSettingsBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $wearSettingsBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $wearSettingsBO->set($arr_error);
            $arr=$wearSettingsBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($wearSettings);
        unset($wearSettingsBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
    });
    
    //View All Wear Rate Parameters
    $app->get('/wearratessettings/parameters', function (Request $request, Response $response, array $args) {
        //Create Objects
        $parameter_mapping=array("Sh"=>"Flange Height",
            "qR"=>"Toe Creep",
            "FW"=>"Flange Width",
            "H"=>"Hollowing"            
        );
        $wearSettings=new WearRatesSetting();
        $wearSettingsBO=new WearRatesBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
        if(isset($_SESSION["staffNumber"])){            
            $wear_settings_arr=$wearSettings->listWearRateParameters();
            if(count($wear_settings_arr)>0){
                foreach($wear_settings_arr["wearRate2DArray"] as $key => $value){
                    $wear_settings_arr["wearRate2DArray"][$key]["paramName"]=$parameter_mapping[$value["paramName"]];
                }
                $wearSettingsBO->set($wear_settings_arr);
                $wearSettingsBO->setTransactionStatus(true);
                $arr=$wearSettingsBO->getArray();
            }
            else $arr=$wearSettingsBO->getArray();           
            $_SESSION["lastActive"]=time();
        }
        else{
            $wearSettingsBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $wearSettingsBO->set($arr_error);
            $arr=$wearSettingsBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($wearSettings);
        unset($wearSettingsBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
    });
    
    //Add
    $app->post('/wearratessettings/add', function (Request $request, Response $response, array $args) {
        //Create Objects
        $wearSettings=new WearRatesSetting();
        $wearSettingsBO=new WearRatesBO();
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
            $activityName="Average Wear Rates Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $wearSettingsBO->set($form_data);
                $wearSettingsBO->setStaffNumber($_SESSION["staffNumber"]);
                $wearSettingsBO->setTransactionStatus($wearSettings->addWearRateSettings($wearSettingsBO));
                $arr=$wearSettingsBO->getArray();
            }
            else{
                $wearSettingsBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"]=$arr_err;
                $wearSettingsBO->set($arr_error);
                $arr=$wearSettingsBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $wearSettingsBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $wearSettingsBO->set($arr_error);
            $arr=$wearSettingsBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($wearSettings);
        unset($wearSettingsBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
        
    });
        
    //Update
    $app->post('/wearratessettings/update', function (Request $request, Response $response, array $args) {
        //Create Objects
        $wearSettings=new WearRatesSetting();
        $wearSettingsBO=new WearRatesBO();
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
            $activityName="Average Wear Rates Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $wearSettingsBO->set($form_data);
                $wearSettingsBO->setStaffNumber($_SESSION["staffNumber"]);
                $wearSettingsBO->setTransactionStatus($wearSettings->updateWearRateSettings($wearSettingsBO));
                $arr=$wearSettingsBO->getArray();
            }
            else{
                $wearSettingsBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"]=$arr_err;
                $wearSettingsBO->set($arr_error);
                $arr=$wearSettingsBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $wearSettingsBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $wearSettingsBO->set($arr_error);
            $arr=$wearSettingsBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($wearSettings);
        unset($wearSettingsBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
        
    });
?>