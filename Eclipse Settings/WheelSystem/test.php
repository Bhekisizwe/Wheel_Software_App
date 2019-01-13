<?php
    use UserClasses\BusinessLayer\AlarmEventLogger;
use UserClasses\BusinessObjects\WheelMeasurementsComparisonBO;

    //phpinfo();

require __DIR__.'/vendor/autoload.php';

$wheelBO=new WheelMeasurementsComparisonBO();
$alarms=new AlarmEventLogger();
$wheelBO->setStaffNumber("305941");
$wheelBO->setAlarmSearchStartDate("2017-01-01");
$wheelBO->setAlarmSearchEndDate("2017-11-30");
$alarms->generateFaultReport($wheelBO);
/*$manualMeasBO->setReportEndDate("2017-04-07");
$manualMeasBO->setStaffNumber("305941");
$reportData=$planningReport->generateReportData($manualMeasBO);
$userRoles=$planningReport->getUserRolesWithReadAccess();
$visibilityArr=$planningReport->getReportColumnsVisibilityPerUserRole($userRoles);
foreach($visibilityArr as $roleID => $value){
    $report=$planningReport->produceReportPerUserRole($value, $reportData);
    $staffNumber="305941";
    $planningReport->writeReportToMSExcel($report, $staffNumber, $roleID);    
}*/

echo "";
echo "";

//$file_path="";
//$status=$userRole->checkUserAuthorization($data,$accessRight,$activityName);





