<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UserClasses\BusinessLayer\AlarmEventLogger;
use UserClasses\BusinessObjects\WheelMeasurementsComparisonBO;
use UserClasses\BusinessLayer\UserRole;
use UserClasses\BusinessObjects\UserRoleBO;
use UserClasses\BusinessLayer\ManageSession;
    //View Alarms for Specific Date Range
    $app->get('/alarmevent/{daterange}', function (Request $request, Response $response, array $args) {
        //Create Objects
        $alarm=new AlarmEventLogger();
        $alarmBO=new WheelMeasurementsComparisonBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        $searchdatesstr=$args["daterange"];
        $date_arr=explode("_",$searchdatesstr);     
        $arr=$alarmBO->getArray();
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
        if(isset($_SESSION["staffNumber"])){
            $userrole_arr["userRole2DArray"][0]["roleID"]=$_SESSION["roleID"];
            $userroleBO->set($userrole_arr);
            $accessRight="R";
            $activityName="Wheel Measurements Management";          
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $arr=array();
                $alarmBO->setAlarmSearchStartDate($date_arr[0]);
                $alarmBO->setAlarmSearchEndDate($date_arr[1]);
                $alarm_arr=$alarm->searchAlarmEvents($alarmBO);
                $alarmBO->setTransactionStatus(true);
                for($j=0;$j<count($alarm_arr);$j++){
                    $alarmBO->set($alarm_arr[$j]);            ;
                    $arr[]=$alarmBO->getArray();
                }
                if(count($alarm_arr)==0){
                    $alarmBO->setTransactionStatus(true);
                    $arr[0]=$alarmBO->getArray();                 
                } 
            }
            else{
                $arr=array();
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"]=$arr_err;
                $alarmBO->set($arr_error);
                $arr[]=$alarmBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
            $alarmBO->setTransactionStatus(false);
            $arr=array();
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $alarmBO->set($arr_error);
            $arr[]=$alarmBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($alarm);
        unset($alarmBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
    });
    
?>
