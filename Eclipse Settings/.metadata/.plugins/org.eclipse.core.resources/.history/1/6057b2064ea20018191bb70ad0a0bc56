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

require __DIR__.'/vendor/autoload.php';

$arr_add=array();
$arr_add["roleID"]="15";
$arr_add["name"]="Bhekisizwe";
$arr_add["surname"]="Mthethwa";
$arr_add["staffNumber"]="305941";
$arr_add["emailAddress"]="tshomie2020@yahoo.com";
$arr_add["accountState"]=1;
$data=new UserAccountBO();
$userAccounts=new UserAccounts();
$data->set($arr_add);
$status_message=$userAccounts->addUserAccount($data);
$err_arr=$userAccounts->getUserAccountBO()->getErrorAssocArray();
print_r($err_arr);
  
//$status=$userRole->checkUserAuthorization($data,$accessRight,$activityName);





