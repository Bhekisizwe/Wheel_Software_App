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

$arr_add=array();
$arr_add["staffNumber"]="305941";
$sender=new Email();
$data=new UserAccountBO();
$activityLog=new ActivityLog();
$data->set($arr_add);
$arr_result=$activityLog->getEmailRecepient($data);
$arr=$activityLog->generateEmailMessage($arr_result);
$sender->sendEmail($arr);
print_r($arr);
  
//$status=$userRole->checkUserAuthorization($data,$accessRight,$activityName);





