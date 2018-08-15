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
$userAccountDL=new UserAccountDL();
$i=0;
$counter=0; //count number of times successfully added a user account
$userAccountDL->delete($arr_add);     //make sure we delete all user accounts
while($i<7){
    $data->set($arr_add);
    $status_message=$userAccounts->addUserAccount($data);
    if($status_message){
        $counter++;
    }
    $i++;
}        
//$status=$userRole->checkUserAuthorization($data,$accessRight,$activityName);





