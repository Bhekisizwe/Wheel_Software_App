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

require __DIR__.'/vendor/autoload.php';

$arr=array();
$activityBO=new ActivityLogBO();
$activityLog=new ActivityLog();
$arr["taskID"]=4;
$arr_2D=array();
$arr_2D["taskArray2D"][0]=$arr;
$arr_2D["staffNumber"]="305941";
$arr_2D["startDate"]="2018-08-14";
$arr_2D["endDate"]="2018-08-31";
$activityBO->set($arr_2D);
$activityLog->generatePDFActivityReport($activityBO);
print_r($arr_results);
  
//$status=$userRole->checkUserAuthorization($data,$accessRight,$activityName);





