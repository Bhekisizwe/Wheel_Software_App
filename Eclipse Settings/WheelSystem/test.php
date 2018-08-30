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
use UserClasses\BusinessLayer\AutoWheelSettings;
use UserClasses\BusinessObjects\AutoWheelSettingsBO;
use UserClasses\BusinessLayer\MiniProfDBUploader;
use UserClasses\BusinessObjects\MiniProfMeasurementsBO;
use UserClasses\DataLayer\UserRoleDL;
use UserClasses\DataLayer\ManualWheelMeasurementsDL;
use UserClasses\BusinessObjects\ManualWheelMeasurementsBO;
use UserClasses\BusinessLayer\ManualWheelMeasurements;

require __DIR__.'/vendor/autoload.php';
$manual=new ManualWheelMeasurements();
$manualBO=new ManualWheelMeasurementsBO();
$manualBO->setCutTyreWidth(23.58);
$manualBO->setCutTyreDistanceFromFlange(35.78);
$manualBO->setSpreadRim(15.56);
$manualBO->setCutTyreDepth(10);
$manualBO->setWheelSkid(0.35);
$manualBO->setMeasurementID(3);
$manualBO->setGibsonDescription("Mfundo there is something wrong here");
$manualBO->setStaffNumber("305941");
/*$manualBO->setReportEndDate("2017-04-07");
$manualBO->setReportStartDate("2017-04-07");
$manualBO->setCoachNumber("10805");
$manualBO->setWheelID(6);
$manualBO->setMeasurementDate("2017-04-07");*/
//$status=$manual->addManualWheelMeasurements($manualBO);
$arr_parse=$manual->updateManualWheelData($manualBO);
//print_r($arr_parse);

echo "";
echo "";

//$file_path="";
//$status=$userRole->checkUserAuthorization($data,$accessRight,$activityName);





