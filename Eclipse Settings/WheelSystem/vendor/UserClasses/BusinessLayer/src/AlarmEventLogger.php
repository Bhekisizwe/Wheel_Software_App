<?php
declare(strict_types=1);
namespace UserClasses\BusinessLayer;

use UserClasses\BusinessObjects\ActivityLogBO;
use UserClasses\DataLayer\AlarmEventLoggerDL;
use UserClasses\BusinessObjects\WheelMeasurementsComparisonBO;
use UserClasses\BusinessObjects\UserAccountBO;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class AlarmEventLogger extends FileHandler
{
    private $activityLog;
    private static $dirPath=__DIR__."\\..\\..\\..\\..\\FaultReport";
    private $activityBO;
    private $alarmEventDL;
    private $err;
    private $sender;
    private $accountBO;

    /**
     */
    public function __construct()
    {
        Parent::__construct(self::$dirPath, "");
        $this->err=new ErrorLog();
        $this->accountBO=new UserAccountBO();
        $this->sender=new Email();
        $this->activityLog=new ActivityLog();
        $this->activityBO=new ActivityLogBO();
        $this->alarmEventDL=new AlarmEventLoggerDL();
    }

    /**
     */
    function __destruct()
    {
        $this->err=null;
        $this->accountBO=null;
        $this->sender=null;
        $this->activityBO=null;
        $this->activityLog=null;
        $this->alarmEventDL=null;        
    }
    
    public function searchAlarmEvents(WheelMeasurementsComparisonBO $data):array {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $arr_result=$this->alarmEventDL->searchData($arr);
            } catch (\Exception $e) {
                $class_name="AlarmEventLogger";
                $method_name="searchAlarmEvents";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $arr_result;
        }
        else{
            $arr=array();
            return $arr;
        }
    }
    
    public function generateFaultReport(WheelMeasurementsComparisonBO $data) {
        if(isset($data)){  
            $arr_search_keys=array("Flange Height",
                "Flange Width",
                "Toe Creep",
                "Hollowing",
                "Gibson Ring",
                "Cut Tyre Depth",
                "Cut Tyre Width",
                "Cut Tyre Distance From Flange",
                "Wheel Skid",
                "Spread Rim"
            );
            $arr_faults=array();    //this will store the fault count in the required order
            $arr_column_names=array(); //Column Names of Excel Spreadsheet Report
            foreach($arr_search_keys as $value){
                $arr_column_names[]=$value." Stops";
            }
            $arr_faults[0]=$arr_column_names;
            $arr_faults[0][]="Report Start Date";
            $arr_faults[0][]="Report End Date";
            $arr=$this->searchAlarmEvents($data);
            //we need to search for all 10 possible stoppage causes and count them
            $total_failures=0;
            for($i=0;$i<count($arr_search_keys);$i++){
                $counter=0; //reset counter that counts number of failure causes.
                for($rows=0;$rows<count($arr);$rows++){
                    //go through each row and search the alarmCause column for the cause of failure
                    $pattern="/(.)*".$arr_search_keys[$i]."(.)*/";
                    if($arr[$rows]["predictedWheelFailureDate"]==$arr[$rows]["referenceDate"]){
                        if(preg_match($pattern, $arr[$rows]["alarmCause"])===1){
                            $counter+=1;    //then we know the cause of stoppage has been found
                        }
                    }                    
                }
                $arr_faults[1][$i]=$counter;
                $total_failures+=$counter;
            }
            $arr_faults[1][]=$data->getAlarmSearchStartDate();
            $arr_faults[1][]=$data->getAlarmSearchEndDate();
            $this->writeReportToMSExcel($arr_faults, $data->getStaffNumber(),$total_failures);
        }
        else return NULL;
    }
    
    private function writeReportToMSExcel(array $reportData,string $staffNumber,int $total_failures) {
        if(count($reportData)>0 && $staffNumber!=""){
            try {
                //check if Directory Exists first
                $filename="report_".$staffNumber.".xlsx";
                if($this->checkDirectoryExists()){
                    //it does. then check if File exists
                    if($this->checkFileExists($filename)){
                        //if it does, delete it
                        $this->deleteFile($filename);
                    }
                    //write data to MSExcel 2007 and Later
                    $this->writeToExcel($reportData,$filename,$total_failures);
                    $this->accountBO->setStaffNumber($staffNumber);
                    $userAccount=$this->getEmailRecepient($this->accountBO);                    
                    $email_message=$this->generateEmailMessage($userAccount, $filename);
                    $this->sender->sendEmail($email_message);                    
                }
                else{
                    //it does not. Create It!
                    if($this->createDirectory()){
                        //write data to MSExcel 2007 and Later
                        $this->writeToExcel($reportData,$filename,$total_failures);
                        $this->accountBO->setStaffNumber($staffNumber);
                        $userAccount=$this->getEmailRecepient($this->accountBO);
                        $email_message=$this->generateEmailMessage($userAccount, $filename);
                        $this->sender->sendEmail($email_message);                    
                    }
                }
            } catch (\Exception $e) {
                $class_name="AlarmEventLogger";
                $method_name="writeReportToMSExcel";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
        }
    }
    
    private function writeToExcel(array $reportData,string $filename,int $total_failures){
        $workBook=new Spreadsheet();
        $alphabet=range("A", "Z");      //create letters of the Alphabet.
        $sheet=$workBook->getActiveSheet();
        for($row=0;$row<count($reportData);$row++){
            //$row is the row position of the report
            for($column=0;$column<count($reportData[$row]);$column++){
                //$column is the column position of the report
                if($total_failures>0 && $column<(count($reportData[$row])-2) && $row>0){
                    $perc=round(($reportData[$row][$column]/$total_failures)*100,2);
                    $cellData=$reportData[$row][$column]." (".$perc."%)";
                }
                else $cellData=$reportData[$row][$column];
                
                $sheet->setCellValue($alphabet[$column]."".($row+1), $cellData);
            }
        }
        $writer=new Xlsx($workBook);
        $fullFilePath=self::$dirPath."\\".$filename;
        $writer->save($fullFilePath);
        //destroy objects
        unset($writer);
        unset($sheet);
        unset($workBook);
    }
    
    private function checkAlarmEventExists(WheelMeasurementsComparisonBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $status_message=$this->alarmEventDL->dataExists($arr);
            } catch (\Exception $e) {
                $class_name="AlarmEventLogger";
                $method_name="checkAlarmEventExists";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            
            return $status_message;
        }
        else return false;
    }
    
    public function addAlarmEvent(WheelMeasurementsComparisonBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                if(!$this->checkAlarmEventExists($data)){
                    //it does not exist, add the event.
                    $status_message=$this->alarmEventDL->create($arr);
                    if($status_message){
                        $arr_data=array();
                        $arr_data["taskArray2D"][0]["taskName"]="Alarm Event Logger";
                        $arr_data["transactionName"]="Adding Alarm Event to Database";
                        $arr_data["activityAction"]=1;      //create
                        $arr_data["staffNumber"]=$data->getStaffNumber();
                        $this->activityBO->set($arr_data);
                        $this->activityLog->addActivityData($this->activityBO);
                    }
                }
                else {
                    //update the alarm event.
                    $status_message=$this->updateAlarmEvent($data);
                }
                                
            } catch (\Exception $e) {
                $class_name="AlarmEventLogger";
                $method_name="addAlarmEvent";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $status_message;
        }
        else return false;
    }
    
    private function updateAlarmEvent(WheelMeasurementsComparisonBO $data):bool {
        if(isset($data)){
            try {
                $arr=$data->getArray();
                $status_message=$this->alarmEventDL->update($arr);
                if($status_message){
                    $arr_data=array();
                    $arr_data["taskArray2D"][0]["taskName"]="Alarm Event Logger";
                    $arr_data["transactionName"]="Updating Alarm Events in Database";
                    $arr_data["activityAction"]=2;      //update
                    $arr_data["staffNumber"]=$data->getStaffNumber();
                    $this->activityBO->set($arr_data);
                    $this->activityLog->addActivityData($this->activityBO);
                }
            } catch (\Exception $e) {
                $class_name="AlarmEventLogger";
                $method_name="updateAlarmEvent";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            return $status_message;
        }
        else return false;
    }
    
    private function getEmailRecepient(UserAccountBO $data):array {
        if(isset($data)){
            $userAccounts=new UserAccounts();
            //extract email address using staffNumber of user.
            $arr_result=$userAccounts->listUserAccount($data);
            unset($userAccounts);
            return $arr_result;
        }
        else return NULL;
    }
    
    private function generateEmailMessage(array $arr,string $filename):array {
        //generate email array
        $arr_email=array();
        $arr_email["to"]=$arr["emailAddress"];
        $arr_email["subject"]="Fault Statistics Report";
        $body="Dear Sir/Madam<p>";
        $body.="Please find attached the requested Fault distribution statistics report. <p>";
        $body.=" By Order (Gqunsu Engineering Pty Ltd)";
        $arr_email["body"]=$body;
        $arr_email["file"]=self::$dirPath."\\".$filename;
        unset($data);
        return $arr_email;
    }
}

