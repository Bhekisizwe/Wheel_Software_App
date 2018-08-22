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

require __DIR__.'/vendor/autoload.php';

$asset=new AssetRegister();
$assetBO=new AssetRegisterBO();
$arr=array();
//$data=new UserAccountBO();
$arr["staffNumber"]="305944";
$assetBO->set($arr);
$arr_results=$asset->readCSVFileAssetsData($assetBO);
print_r($arr_results);
//$file_path="";
//$status=$userRole->checkUserAuthorization($data,$accessRight,$activityName);





