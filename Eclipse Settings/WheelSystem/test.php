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

require __DIR__.'/vendor/autoload.php';

$asset=new AssetRegister();
//$data=new UserAccountBO();
$filename="305941.csv";
$status=$asset->checkRowsForEmptySpaces($filename);
var_dump($status);
//$file_path="";
//$status=$userRole->checkUserAuthorization($data,$accessRight,$activityName);





