<?php
declare(strict_types=1);
namespace UserClasses\BusinessLayer;

use UserClasses\BusinessObjects\WheelMeasurementsComparisonBO;
use UserClasses\BusinessObjects\ManualWheelMeasurementsBO;
use UserClasses\BusinessObjects\DailyDistanceSettingBO;
use UserClasses\BusinessObjects\WearRatesBO;
use UserClasses\BusinessObjects\ManualWheelSettingsBO;
use UserClasses\BusinessObjects\AutoWheelSettingsBO;
use UserClasses\DataLayer\AssetRegisterDL;
use UserClasses\DataLayer\UserAccountDL;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class WheelMeasurementsComparison
{
    private $err;
    private $manualWheelMeas;
    private $autoWheelSettings;
    private $manualWheelSettings;   
    private $manualMeasBO;
    private $wearRates;
    private $wearRatesBO;
    private $dailyDistance;
    private $dailyDistanceBO;
    private $sender;
    private $alarmLogger;

    /**
     */
    public function __construct()
    {
        $this->err=new ErrorLog();
        $this->sender=new Email();
        $this->manualWheelMeas=new ManualWheelMeasurements();
        $this->autoWheelSettings=new AutoWheelSettings();
        $this->manualWheelSettings=new ManualWheelSettings();
        $this->manualMeasBO=new ManualWheelMeasurementsBO();
        $this->wearRates=new WearRatesSetting();
        $this->dailyDistance=new DailyDistanceSetting();
        $this->dailyDistanceBO=new DailyDistanceSettingBO();
        $this->wearRatesBO=new WearRatesBO();
        $this->alarmLogger=new AlarmEventLogger();
    }

    /**
     */
    function __destruct()
    {
        $this->err=null;
        $this->sender=null;
        $this->manualWheelMeas=null;
        $this->autoWheelSettings=null;
        $this->manualWheelSettings=null;
        $this->manualMeasBO=null;
        $this->wearRates=null;
        $this->dailyDistance=null;
        $this->dailyDistanceBO=null;
        $this->wearRatesBO=null;
        $this->alarmLogger=null;
    }
    
    public function checkManualSettingsExist(ManualWheelSettingsBO $data):bool {
        if(isset($data)){
            $arr=$this->manualWheelSettings->showGlobalWheelSettings($data);
            $status_message=false;
            if(count($arr)>0){
                foreach($arr["warning2DArray"] as $value){
                    if(array_search("CTD",$value)=="paramName"){
                        $status_message=true;
                        break;
                    }
                }
                return $status_message;
            }
            else return $status_message;            
        }
        else return false;
    }
    
    public function checkAutoSettingsExist(ManualWheelMeasurementsBO $data):bool {
        if(isset($data)){
            $asset=new AssetRegisterDL();
            $arr_data=$data->getArray();
            $coachID=$asset->getCoachIDFromCoachNumber($arr_data);
            $arr["alarms2DArray"][0]["coachID"]=$coachID;
            $autosettings=new AutoWheelSettingsBO();
            $autosettings->set($arr);
            $arr_result=$this->autoWheelSettings->showCoachWheelSettings($autosettings);
            //destroy objects
            unset($autosettings);
            unset($asset);
            if(count($arr_result)>0){
                if(count($arr_result["warning2DArray"])>=4){
                    return true;
                }
                else return false;
            }
            else return false;
        }
        else return false;
    }
    
    public function checkWearRatesSettingsExist():bool {       
        $arr=$this->wearRates->showWearRateSettings($this->wearRatesBO);
        if(count($arr)>0){
            if(count($arr["wearRate2DArray"])>=4){
                return true;
            }
            else return false;
        }
        else return false;            
    }
    
    public function checkDailyDistanceSettingExists():bool {        
        $arr=$this->dailyDistance->showDistanceSetting($this->dailyDistanceBO);
        if(count($arr)>0){
            return true;
        }
        else return false;       
    }    
    
    private function getWheelMeasurements(ManualWheelMeasurementsBO $data):array {
        if(isset($data)){
            $arr=$this->manualWheelMeas->getWheelReportData($data); 
            return $arr;
        }
        else return NULL;
    }
    
    private function compareWheelMeasurementsToSettings(array $data,AutoWheelSettingsBO $autosettings,ManualWheelSettingsBO $manualsettings):array {
        if(isset($data)){
            //compare MiniProf Measured Parameters with Alarm and Warning Thresholds
            //get the CoachID first in order to retreive the correct MiniProf settings
            try {
                $asset=new AssetRegisterDL();
                $coachID=$asset->getCoachIDFromCoachNumber($data);
                $arr["alarms2DArray"][0]["coachID"]=$coachID;
                $autosettings->set($arr);
            } catch (Exception $e) {
                $class_name="WheelMeasurementsComparison";
                $method_name="compareWheelMeasurementsToSettings";
                $this->err->logErrors($e,null,$class_name, $method_name);
            }
            finally{
                unset($asset);
            }  
            $data["addToExceptionList"]=false;  //Flag to see which wheel needs to be added to the List
            //get Auto Wheel settings
            $arr_auto_settings=$this->autoWheelSettings->showCoachWheelSettings($autosettings);
            for($i=0;$i<count($arr_auto_settings["warning2DArray"]);$i++){
                switch($arr_auto_settings["warning2DArray"][$i]["paramName"]){
                    case "Sh":  //flange height comparison                       
                        if($data["flangeHeight"]>=$arr_auto_settings["alarms2DArray"][$i]["alarmLevel"]){
                            $data["flangeHeightStatus"]=2;  
                            $data["addToExceptionList"]=true;
                        }
                        if($data["flangeHeight"]>=$arr_auto_settings["warning2DArray"][$i]["warningLevel"]){
                            $data["flangeHeightStatus"]=3; 
                            $data["addToExceptionList"]=true;
                        }
                        break;
                    case "qR":  //Toe Creep comparison
                        if($data["toeCreep"]<=$arr_auto_settings["alarms2DArray"][$i]["alarmLevel"]){
                            $data["toeCreepStatus"]=2;
                            $data["addToExceptionList"]=true;
                        }
                        if($data["toeCreep"]<=$arr_auto_settings["warning2DArray"][$i]["warningLevel"]){
                            $data["toeCreepStatus"]=3;
                            $data["addToExceptionList"]=true;
                        }
                        break;
                    case "FW":  //Flange Width Comparison
                        if($data["flangeWidth"]<=$arr_auto_settings["alarms2DArray"][$i]["alarmLevel"]){
                            $data["flangeWidthStatus"]=2;
                            $data["addToExceptionList"]=true;
                        }
                        if($data["flangeWidth"]<=$arr_auto_settings["warning2DArray"][$i]["warningLevel"]){
                            $data["flangeWidthStatus"]=3;
                            $data["addToExceptionList"]=true;
                        }
                        break;
                    case "H":   //Hollowing Comparison
                        if(abs($data["hollowing"])>=abs($arr_auto_settings["alarms2DArray"][$i]["alarmLevel"])){
                            $data["hollowingStatus"]=2;
                            $data["addToExceptionList"]=true;
                        }
                        if(abs($data["hollowing"])>=abs($arr_auto_settings["warning2DArray"][$i]["warningLevel"])){
                            $data["hollowingStatus"]=3;
                            $data["addToExceptionList"]=true;
                        }
                }
            }
            //compare the Manually measured wheel measurements to the thresholds
            //get the manual settings first!
            $arr_manual_settings=$this->manualWheelSettings->showGlobalWheelSettings($manualsettings);
            for($i=0;$i<count($arr_manual_settings["warning2DArray"]);$i++){
                switch($arr_manual_settings["warning2DArray"][$i]["paramName"]){
                    case "CTD":  //Cut Tyre Depth comparison                       
                        if($data["cutTyreDepth"]>=$arr_manual_settings["warning2DArray"][$i]["warningLevel"]){
                            $data["cutTyreDepthStatus"]=2;
                            $data["addToExceptionList"]=true;
                        }
                        break;
                    case "CTW":  //Cut Tyre Width comparison                      
                        if($data["cutTyreWidth"]>=$arr_manual_settings["warning2DArray"][$i]["warningLevel"]){
                            $data["cutTyreWidthStatus"]=2;
                            $data["addToExceptionList"]=true;
                        }
                        break;
                    case "CTDFF":  //Cut Tyre Distance From Flange Comparison                      
                        if($data["cutTyreDistanceFromFlange"]>=$arr_manual_settings["warning2DArray"][$i]["warningLevel"]){
                            $data["cutTyreDistanceFromFlangeStatus"]=2;
                            $data["addToExceptionList"]=true;
                        }
                        break;
                    case "SR":   //Spread Rim Comparison                        
                        if($data["spreadRim"]>=$arr_manual_settings["warning2DArray"][$i]["warningLevel"]){
                            $data["spreadRimStatus"]=2;
                            $data["addToExceptionList"]=true;
                        }
                        break;
                    case "WS":   //Wheel Skid Comparison                       
                        if($data["wheelSkid"]>=$arr_manual_settings["warning2DArray"][$i]["warningLevel"]){
                            $data["wheelSkidStatus"]=2;
                            $data["addToExceptionList"]=true;
                        }                        
                }
            }
            $this->manualMeasBO->setMeasurementID($data["measurementID"]);
            $manual_arr=$this->manualWheelMeas->showManualWheelData($this->manualMeasBO);
            if(count($manual_arr)>0){
                if($manual_arr[0]["gibsonDescription"]=="fail"){
                    $data["gibsonStatus"]=2;
                    $data["addToExceptionList"]=true;
                }
            }                       
            if($data["addToExceptionList"]==true){
                //calculate failure dates for only those that have violated the alarm and warning settings
                $arr_result=$this->predictFailureDate($data, $arr_auto_settings);
            }
            else $arr_result=$data;
            return $arr_result;
        }
        else return NULL;
    }
    
    private function predictFailureDate(array $data,array $autosettings):array {
        if(isset($data)){
            $arr_predicted_dates=array();  
            //get the distance travelled daily
            $distance_arr=$this->dailyDistance->showDistanceSetting($this->dailyDistanceBO);  
            //get the Wear Rate per kilometer
            $wearrate_arr=$this->wearRates->showWearRateSettings($this->wearRatesBO);
            foreach($data as $key => $value){
                switch($key){
                    case "flangeHeightStatus":
                        if($value==3){
                            //warning level violated therefore the failure date is today's date.                            
                            $arr_predicted_dates["Flange Height"]=$data["measurementDate"];  
                            $arr["Flange Height"]["defectSize"]=$data["flangeHeight"];
                            $arr["Flange Height"]["daysBeforeFailure"]=0;
                        }
                        elseif($value==2){
                            //calculate failure date using formula. Only alarm level has been violated
                            for($i=0;$i<count($autosettings);$i++){
                                if($autosettings["warning2DArray"][$i]["paramName"]=="Sh"){
                                    $warningLevel=$autosettings["warning2DArray"][$i]["warningLevel"];
                                }
                            }                            
                            for($j=0;$j<count($wearrate_arr["wearRate2DArray"]);$j++){
                                if($wearrate_arr["wearRate2DArray"][$j]["paramName"]=="Sh"){
                                    $wearRate=$wearrate_arr["wearRate2DArray"][$j]["wearRate"];
                                }
                            }
                            $daystofailure=abs($data["flangeHeight"]-$warningLevel)/($distance_arr["distance"]*$wearRate);
                            $numberOfDaysLeft=floor($daystofailure);
                            $dateObj=new \DateTime($data["measurementDate"]);
                            $dateObj->add(new \DateInterval("P".$numberOfDaysLeft."D"));
                            $arr_predicted_dates["Flange Height"]=$dateObj->format("Y-m-d");
                            $arr["Flange Height"]["defectSize"]=$data["flangeHeight"];
                            $arr["Flange Height"]["daysBeforeFailure"]=$numberOfDaysLeft;
                            unset($dateObj);
                        }
                        else{
                            //do nothing
                        }                        
                        break;
                    case "flangeWidthStatus":
                        if($value==3){
                            //warning level violated therefore the failure date is the Date of Measurement
                            $arr_predicted_dates["Flange Width"]=$data["measurementDate"];
                            $arr["Flange Width"]["defectSize"]=$data["flangeWidth"];
                            $arr["Flange Width"]["daysBeforeFailure"]=0;
                        }
                        elseif($value==2){
                            //calculate failure date using formula. Only alarm level has been violated
                            for($i=0;$i<count($autosettings);$i++){
                                if($autosettings["warning2DArray"][$i]["paramName"]=="FW"){
                                    $warningLevel=$autosettings["warning2DArray"][$i]["warningLevel"];
                                }
                            }                           
                            
                            for($j=0;$j<count($wearrate_arr["wearRate2DArray"]);$j++){
                                if($wearrate_arr["wearRate2DArray"][$j]["paramName"]=="FW"){
                                    $wearRate=$wearrate_arr["wearRate2DArray"][$j]["wearRate"];
                                }
                            }
                            $daystofailure=abs($data["flangeWidth"]-$warningLevel)/($distance_arr["distance"]*$wearRate);
                            $numberOfDaysLeft=floor($daystofailure);
                            $dateObj=new \DateTime($data["measurementDate"]);
                            $dateObj->add(new \DateInterval("P".$numberOfDaysLeft."D"));
                            $arr_predicted_dates["Flange Width"]=$dateObj->format("Y-m-d");
                            $arr["Flange Width"]["defectSize"]=$data["flangeWidth"];
                            $arr["Flange Width"]["daysBeforeFailure"]=$numberOfDaysLeft;
                            unset($dateObj);
                        }
                        else{
                            //do nothing
                        }                        
                        break;
                    case "toeCreepStatus":
                        if($value==3){
                            //warning level violated therefore the failure date is the Date of Measurement
                            $arr_predicted_dates["Toe Creep"]=$data["measurementDate"];
                            $arr["Toe Creep"]["defectSize"]=$data["toeCreep"];
                            $arr["Toe Creep"]["daysBeforeFailure"]=0;
                        }
                        elseif($value==2){
                            //calculate failure date using formula. Only alarm level has been violated
                            for($i=0;$i<count($autosettings);$i++){
                                if($autosettings["warning2DArray"][$i]["paramName"]=="qR"){
                                    $warningLevel=$autosettings["warning2DArray"][$i]["warningLevel"];
                                }
                            }
                            
                            for($j=0;$j<count($wearrate_arr["wearRate2DArray"]);$j++){
                                if($wearrate_arr["wearRate2DArray"][$j]["paramName"]=="qR"){
                                    $wearRate=$wearrate_arr["wearRate2DArray"][$j]["wearRate"];
                                }
                            }
                            $daystofailure=abs($data["toeCreep"]-$warningLevel)/($distance_arr["distance"]*$wearRate);
                            $numberOfDaysLeft=floor($daystofailure);
                            $dateObj=new \DateTime($data["measurementDate"]);
                            $dateObj->add(new \DateInterval("P".$numberOfDaysLeft."D"));
                            $arr_predicted_dates["Toe Creep"]=$dateObj->format("Y-m-d");
                            $arr["Toe Creep"]["defectSize"]=$data["toeCreep"];
                            $arr["Toe Creep"]["daysBeforeFailure"]=$numberOfDaysLeft;
                            unset($dateObj);
                        }
                        else{
                            //do nothing
                        } 
                        break;
                    case "hollowingStatus":
                        if($value==3){
                            //warning level violated therefore the failure date is the Date of Measurement
                            $arr_predicted_dates["Hollowing"]=$data["measurementDate"];
                            $arr["Hollowing"]["defectSize"]=$data["hollowing"];
                            $arr["Hollowing"]["daysBeforeFailure"]=0;
                        }
                        elseif($value==2){
                            //calculate failure date using formula. Only alarm level has been violated
                            for($i=0;$i<count($autosettings);$i++){
                                if($autosettings["warning2DArray"][$i]["paramName"]=="H"){
                                    $warningLevel=$autosettings["warning2DArray"][$i]["warningLevel"];
                                }
                            }
                            
                            for($j=0;$j<count($wearrate_arr["wearRate2DArray"]);$j++){
                                if($wearrate_arr["wearRate2DArray"][$j]["paramName"]=="H"){
                                    $wearRate=$wearrate_arr["wearRate2DArray"][$j]["wearRate"];
                                }
                            }
                            $daystofailure=abs($data["hollowing"]-$warningLevel)/($distance_arr["distance"]*$wearRate);
                            $numberOfDaysLeft=floor($daystofailure);
                            $dateObj=new \DateTime($data["measurementDate"]);
                            $dateObj->add(new \DateInterval("P".$numberOfDaysLeft."D"));
                            $arr_predicted_dates["Hollowing"]=$dateObj->format("Y-m-d");
                            $arr["Hollowing"]["defectSize"]=$data["hollowing"];
                            $arr["Hollowing"]["daysBeforeFailure"]=$numberOfDaysLeft;
                            unset($dateObj);
                        }
                        else{
                            //do nothing
                        } 
                        break;
                    case "spreadRimStatus":        
                        if($value==2){
                            //warning level violated therefore the failure date is the Date of Measurement
                            $arr_predicted_dates["Spread Rim"]=$data["measurementDate"];
                            $arr["Spread Rim"]["defectSize"]=$data["spreadRim"];
                            $arr["Spread Rim"]["daysBeforeFailure"]=0;
                        }
                        else{
                            //do nothing
                        }
                        break;
                    case "wheelSkidStatus":                        
                        if($value==2){
                            //warning level violated therefore the failure date is the Date of Measurement
                            $arr_predicted_dates["Wheel Skid"]=$data["measurementDate"];
                            $arr["Wheel Skid"]["defectSize"]=$data["wheelSkid"];
                            $arr["Wheel Skid"]["daysBeforeFailure"]=0;
                        }
                        else{
                            //do nothing
                        }
                        break;
                    case "cutTyreDepthStatus":                        
                        if($value==2){
                            //warning level violated therefore the failure date is the Date of Measurement
                            $arr_predicted_dates["Cut Tyre Depth"]=$data["measurementDate"];
                            $arr["Cut Tyre Depth"]["defectSize"]=$data["cutTyreDepth"];
                            $arr["Cut Tyre Depth"]["daysBeforeFailure"]=0;
                        }
                        else{
                            //do nothing
                        }
                        break;
                    case "cutTyreWidthStatus":                        
                        if($value==2){
                            //warning level violated therefore the failure date is the Date of Measurement
                            $arr_predicted_dates["Cut Tyre Width"]=$data["measurementDate"];
                            $arr["Cut Tyre Width"]["defectSize"]=$data["cutTyreWidth"];
                            $arr["Cut Tyre Width"]["daysBeforeFailure"]=0;
                        }
                        else{
                            //do nothing
                        } 
                        break;
                    case "cutTyreDistanceFromFlangeStatus":
                        if($value==2){
                            //warning level violated therefore the failure date is the Date of Measurement
                            $arr_predicted_dates["Cut Tyre Distance From Flange"]=$data["measurementDate"];
                            $arr["Cut Tyre Distance From Flange"]["defectSize"]=$data["cutTyreDistanceFromFlange"];
                            $arr["Cut Tyre Distance From Flange"]["daysBeforeFailure"]=0;
                        }
                        else{
                            //do nothing
                        } 
                        break;
                    case "gibsonStatus":
                        if($value==2){
                            //Gibson Ring Inspection Failed
                            $arr_predicted_dates["Gibson"]=$data["measurementDate"];
                            $arr["Gibson"]["defectSize"]=0;
                            $arr["Gibson"]["daysBeforeFailure"]=0;
                        }
                        else{
                            //do nothing
                        } 
                        
                }
            }
            //determine closest date to the measurement date.            
            $data["defectSize"]=$arr[array_search(min($arr_predicted_dates), $arr_predicted_dates)]["defectSize"];
            $data["referenceDate"]=$data["measurementDate"];
            $data["daysBeforeFailure"]=$arr[array_search(min($arr_predicted_dates), $arr_predicted_dates)]["daysBeforeFailure"];
            $data["predictedWheelFailureDate"]=min($arr_predicted_dates); 
            if(array_search(min($arr_predicted_dates), $arr_predicted_dates)=="Gibson"){
                $data["alarmCause"]="The Gibson Ring has Failed it's inspection";
            }
            else $data["alarmCause"]="The ".array_search(min($arr_predicted_dates), $arr_predicted_dates)." has violated the wheel alarm settings thresholds";
            return $data;
        }
        else return NULL;
    }
    
    public function getMeasurementsExceptionList(ManualWheelMeasurementsBO $data):array {
        if(isset($data)) {
            $exceptionList=array();
            $missingCoachList=array();
            $wheelMeasCompareBO=new WheelMeasurementsComparisonBO();
            $manualsettings=new ManualWheelSettingsBO();
            $autosettings=new AutoWheelSettingsBO();
            $arr=$this->getWheelMeasurements($data); //get wheel measurements between the specified start and end dates
            //compare settings to wheel measurements. Calculate the predicted failure date too
            foreach($arr as $value){
                //loop through all wheel measurements               
                $data->setCoachNumber($value["coachNumber"]);
                if($this->checkAutoSettingsExist($data)){
                    $arr_list=$this->compareWheelMeasurementsToSettings($value, $autosettings, $manualsettings);
                    if($arr_list["addToExceptionList"]==true){
                        $exceptionList[]=$arr_list;
                        $arr_list["staffNumber"]=$data->getStaffNumber();
                        $wheelMeasCompareBO->set($arr_list);
                        $this->alarmLogger->addAlarmEvent($wheelMeasCompareBO);
                    }
                }
                else{
                    //record the Coach Number with missing MiniProf threshold settings or missing entry in Asset Register                    
                    $missingCoachList[]=$value["coachNumber"];
                }    
            
            }
            if(count($missingCoachList)>0){
                //we know there is something wrong. Send Email of this to Administrator
                $coachList=array_unique($missingCoachList); //make sure Coach Numbers are Unique
                $recepients_accounts=$this->getEmailReceipients();
                foreach($recepients_accounts as $value){
                    //send emails to all the administrators.
                    $email_arr=$this->generateEmailMessage($value, $coachList);
                    $this->sender->sendEmail($email_arr);
                }
            }
            //destroy objects
            unset($manualsettings);
            unset($wheelMeasCompareBO);
            unset($autosettings);
            return $exceptionList;
        }
        else return NULL;
    }
    
    private function getEmailReceipients():array {
        $userRole=new UserRole();  
        $userAccountDL=new UserAccountDL();
        //extract all user roles
        $arr=$userRole->listAllUserRoles();
        if(count($arr)>0){
            foreach($arr["userRole2DArray"] as $value){
                if($value["userRoleName"]=="Admin"){
                    //get the RoleID of the Administrator
                    $roleID=$value["roleID"];
                    break;
                }
            }
            $data["roleID"]=$roleID;
            //search for the user accounts that are assigned to the Administrator user role.
            $arr_accounts=$userAccountDL->searchUsingRoleID($data);
            //destroy objects 
            unset($userAccountDL);
            unset($userRole);
            return $arr_accounts;
        }
        else {
            unset($userAccountDL);
            unset($userRole);
            return $arr;        
        }
    }
    
    private function generateEmailMessage(array $arr,array $coachList):array {
        $arr_email["to"]=$arr["emailAddress"];
        $arr_email["subject"]="Missing Settings";
        $body="Dear ".$arr["name"]." ".$arr["surname"]."<p>";
        $body.="Please login into the website and make sure that the wheel measurement alarm settings for the coach(s) ".implode(",",$coachList)."<br>";
        $body.="are actually setup. Also make sure that these listed coach(s) are included in the system Asset Register.<p>";    
        $body.=" By Order (Gqunsu Engineering Pty Ltd)";
        $arr_email["body"]=$body; 
        return $arr_email;
    }
}

