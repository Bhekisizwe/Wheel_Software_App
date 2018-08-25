<?php
    //phpinfo();
use UserClasses\BusinessLayer\License;
use UserClasses\BusinessObjects\SystemLicenseBO;
use UserClasses\BusinessLayer\Email;
use UserClasses\DataLayer\SystemLicenseDL;
use UserClasses\BusinessLayer\TermsAndConditions;
use UserClasses\BusinessObjects\TermsConditionsBO;
use UserClasses\BusinessObjects\UserRoleBO;
use UserClasses\BusinessLayer\UserRole;
use UserClasses\BusinessLayer\UserAccounts;
use UserClasses\BusinessObjects\UserAccountBO;
use UserClasses\DataLayer\UserAccountDL;
use UserClasses\BusinessObjects\ActivityLogBO;
use UserClasses\BusinessLayer\ActivityLog;
use UserClasses\BusinessLayer\AssetRegister;
use UserClasses\BusinessObjects\AssetRegisterBO;
use UserClasses\BusinessLayer\AxleCoachMapping;
use UserClasses\BusinessObjects\AxleCoachMappingBO;
use UserClasses\BusinessLayer\WearRatesSetting;
use UserClasses\BusinessObjects\WearRatesBO;

require __DIR__.'/vendor/autoload.php';
$activityLog=new ActivityLog();
$activityBO=new ActivityLogBO();
$arr_2D=array();
$arr_2D["staffNumber"]="305941";
$arr_2D["taskArray2D"][0]["taskID"]=2;
$arr_2D["taskArray2D"][1]["taskID"]=5;
$arr_2D["taskArray2D"][2]["taskID"]=1;
$arr_2D["taskArray2D"][3]["taskID"]=6;
$arr_2D["taskArray2D"][4]["taskID"]=7;
$arr_2D["taskArray2D"][5]["taskID"]=4;
$arr_2D["startDate"]="2018-08-14";
$arr_2D["endDate"]="2018-12-31";
$activityBO->set($arr_2D);
$activityLog->generatePDFActivityReport($activityBO);
//$file_path="";
//$status=$userRole->checkUserAuthorization($data,$accessRight,$activityName);





