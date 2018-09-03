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
use UserClasses\DataLayer\AlarmEventLoggerDL;
use UserClasses\BusinessObjects\WheelMeasurementsComparisonBO;
use UserClasses\DataLayer\WheelReprofilingDL;
use UserClasses\BusinessObjects\WheelReprofilingDataBO;
use UserClasses\BusinessLayer\WheelReprofilingData;
use UserClasses\BusinessLayer\WheelMeasurementsComparison;
use UserClasses\BusinessObjects\ManualWheelSettingsBO;

require __DIR__.'/vendor/autoload.php';

$wheelComparison=new WheelMeasurementsComparison();
$manualMeasBO=new ManualWheelMeasurementsBO();
$manualMeasBO->setReportStartDate("2017-03-25");
$manualMeasBO->setReportEndDate("2017-04-07");
$arr=$wheelComparison->getMeasurementsExceptionList($manualMeasBO);
echo "";
echo "";

//$file_path="";
//$status=$userRole->checkUserAuthorization($data,$accessRight,$activityName);





