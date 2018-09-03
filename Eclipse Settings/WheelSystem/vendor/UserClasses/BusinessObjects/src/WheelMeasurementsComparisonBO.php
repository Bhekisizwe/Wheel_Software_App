<?php
declare(strict_types=1);
namespace UserClasses\BusinessObjects;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class WheelMeasurementsComparisonBO extends ManualWheelMeasurementsBO
{
    private $refID=0;
    private $flangeHeightStatus=1;
    private $toeCreepStatus=1;
    private $flangeWidthStatus=1;
    private $hollowingStatus=1;
    private $spreadRimStatus=1;
    private $wheelSkidStatus=1;
    private $cutTyreWidthStatus=1;
    private $cutTyreDepthStatus=1;
    private $cutTyreDistanceFromFlangeStatus=1;
    private $predictedWheelFailureDate="";
    private $referenceDate="";
    private $alarmCause="";
    private $defectSize=0.0;
    private $alarmSearchStartDate="";
    private $alarmSearchEndDate="";
    
    /**
     */
    public function __construct()
    {
        parent::__construct();
        $this->setObjectNumOfFields(42);
    }
    
    /**
     * @return mixed
     */
    public function getRefID()
    {
        return $this->refID;
    }

    /**
     * @return number
     */
    public function getFlangeHeightStatus()
    {
        return $this->flangeHeightStatus;
    }

    /**
     * @return number
     */
    public function getToeCreepStatus()
    {
        return $this->toeCreepStatus;
    }

    /**
     * @return number
     */
    public function getFlangeWidthStatus()
    {
        return $this->flangeWidthStatus;
    }

    /**
     * @return number
     */
    public function getHollowingStatus()
    {
        return $this->hollowingStatus;
    }

    /**
     * @return number
     */
    public function getSpreadRimStatus()
    {
        return $this->spreadRimStatus;
    }

    /**
     * @return number
     */
    public function getWheelSkidStatus()
    {
        return $this->wheelSkidStatus;
    }

    /**
     * @return number
     */
    public function getCutTyreWidthStatus()
    {
        return $this->cutTyreWidthStatus;
    }

    /**
     * @return number
     */
    public function getCutTyreDepthStatus()
    {
        return $this->cutTyreDepthStatus;
    }

    /**
     * @return number
     */
    public function getCutTyreDistanceFromFlangeStatus()
    {
        return $this->cutTyreDistanceFromFlangeStatus;
    }

    /**
     * @return string
     */
    public function getPredictedWheelFailureDate()
    {
        return $this->predictedWheelFailureDate;
    }

    /**
     * @return string
     */
    public function getReferenceDate()
    {
        return $this->referenceDate;
    }

    /**
     * @return string
     */
    public function getAlarmCause()
    {
        return $this->alarmCause;
    }

    /**
     * @return number
     */
    public function getDefectSize()
    {
        return $this->defectSize;
    }

    /**
     * @return string
     */
    public function getAlarmSearchStartDate()
    {
        return $this->alarmSearchStartDate;
    }

    /**
     * @return string
     */
    public function getAlarmSearchEndDate()
    {
        return $this->alarmSearchEndDate;
    }

    /**
     * @param mixed $refID
     */
    public function setRefID($refID)
    {
        $this->refID = $refID;
    }

    /**
     * @param number $flangeHeightStatus
     */
    public function setFlangeHeightStatus($flangeHeightStatus)
    {
        $this->flangeHeightStatus = $flangeHeightStatus;
    }

    /**
     * @param number $toeCreepStatus
     */
    public function setToeCreepStatus($toeCreepStatus)
    {
        $this->toeCreepStatus = $toeCreepStatus;
    }

    /**
     * @param number $flangeWidthStatus
     */
    public function setFlangeWidthStatus($flangeWidthStatus)
    {
        $this->flangeWidthStatus = $flangeWidthStatus;
    }

    /**
     * @param number $hollowingStatus
     */
    public function setHollowingStatus($hollowingStatus)
    {
        $this->hollowingStatus = $hollowingStatus;
    }

    /**
     * @param number $spreadRimStatus
     */
    public function setSpreadRimStatus($spreadRimStatus)
    {
        $this->spreadRimStatus = $spreadRimStatus;
    }

    /**
     * @param number $wheelSkidStatus
     */
    public function setWheelSkidStatus($wheelSkidStatus)
    {
        $this->wheelSkidStatus = $wheelSkidStatus;
    }

    /**
     * @param number $cutTyreWidthStatus
     */
    public function setCutTyreWidthStatus($cutTyreWidthStatus)
    {
        $this->cutTyreWidthStatus = $cutTyreWidthStatus;
    }

    /**
     * @param number $cutTyreDepthStatus
     */
    public function setCutTyreDepthStatus($cutTyreDepthStatus)
    {
        $this->cutTyreDepthStatus = $cutTyreDepthStatus;
    }

    /**
     * @param number $cutTyreDistanceFromFlangeStatus
     */
    public function setCutTyreDistanceFromFlangeStatus($cutTyreDistanceFromFlangeStatus)
    {
        $this->cutTyreDistanceFromFlangeStatus = $cutTyreDistanceFromFlangeStatus;
    }

    /**
     * @param string $predictedWheelFailureDate
     */
    public function setPredictedWheelFailureDate($predictedWheelFailureDate)
    {
        $this->predictedWheelFailureDate = $predictedWheelFailureDate;
    }

    /**
     * @param string $referenceDate
     */
    public function setReferenceDate($referenceDate)
    {
        $this->referenceDate = $referenceDate;
    }

    /**
     * @param string $alarmCause
     */
    public function setAlarmCause($alarmCause)
    {
        $this->alarmCause = $alarmCause;
    }

    /**
     * @param number $defectSize
     */
    public function setDefectSize($defectSize)
    {
        $this->defectSize = $defectSize;
    }

    /**
     * @param string $alarmSearchStartDate
     */
    public function setAlarmSearchStartDate($alarmSearchStartDate)
    {
        $this->alarmSearchStartDate = $alarmSearchStartDate;
    }

    /**
     * @param string $alarmSearchEndDate
     */
    public function setAlarmSearchEndDate($alarmSearchEndDate)
    {
        $this->alarmSearchEndDate = $alarmSearchEndDate;
    }

    public function set(array $data){
        
        foreach($data as $key => $value){
            //make the Key case insensitive by making the string comparison to be lower case
            $key_lower=strtolower($key);
            switch($key_lower){
                case "flangeheightstatus":
                    $this->flangeHeightStatus=$value;
                    break;
                case "flangewidthstatus":
                    $this->flangeWidthStatus=$value;
                    break;
                case "toecreepstatus":
                    $this->toeCreepStatus=$value;
                    break;
                case "hollowingstatus":
                    $this->hollowingStatus=$value;
                    break;
                case "spreadrimstatus":
                    $this->spreadRimStatus=$value;
                    break;
                case "wheelskidstatus":
                    $this->wheelSkidStatus=$value;
                    break;
                case "cuttyrewidthstatus":
                    $this->cutTyreWidthStatus=$value;
                    break;
                case "cuttyredepthstatus":
                    $this->cutTyreDepthStatus=$value;
                    break;
                case "cuttyredistancefromflangestatus":
                    $this->cutTyreDistanceFromFlangeStatus=$value;
                    break;
                case "predictedwheelfailuredate":
                    $this->predictedWheelFailureDate=$value;
                    break;
                case "referencedate":
                    $this->referenceDate=$value;
                    break;
                case "alarmcause":
                    $this->alarmCause=$value;
                    break;
                case "defectsize":
                    $this->defectSize=$value;
                    break;
                case "alarmsearchstartdate":
                    $this->alarmSearchStartDate=$value;
                    break;
                case "alarmsearchenddate":
                    $this->alarmSearchEndDate=$value;
                    break;               
                case "manualid":
                    $this->manualID=$value;
                    break;
                case "gibsondescription":
                    $this->gibsonDescription=$value;
                    break;
                case "spreadrim":
                    $this->spreadRim=$value;
                    break;
                case "wheelskid":
                    $this->wheelSkid=$value;
                    break;
                case "cuttyrewidth":
                    $this->cutTyreWidth=$value;
                    break;
                case "cuttyredepth":
                    $this->cutTyreDepth=$value;
                    break;
                case "cuttyredistancefromflange":
                    $this->cutTyreDistanceFromFlange=$value;
                    break;
                case "reportstartdate":
                    $this->reportStartDate=$value;
                    break;
                case "reportenddate":
                    $this->reportEndDate=$value;
                    break;
                case "staffnumber":
                    $this->staffNumber=$value;
                    break;
                case "measurementid":
                    $this->measurementID=$value;
                    break;
                case "coachnumber":
                    $this->coachNumber=$value;
                    break;
                case "setnumber":
                    $this->setNumber=$value;
                    break;
                case "axlenumber":
                    $this->axleNumber=$value;
                    break;
                case "wheelid":
                    $this->wheelID=$value;
                    break;
                case "operatorname":
                    $this->operatorName=$value;
                    break;
                case "measurementdate":
                    $this->measurementDate=$value;
                    break;
                case "measurementtime":
                    $this->measurementTime=$value;
                    break;
                case "flangeheight":
                    $this->flangeHeight=$value;
                    break;
                case "toecreep":
                    $this->toeCreep=$value;
                    break;
                case "flangewidth":
                    $this->flangeWidth=$value;
                    break;
                case "hollowing":
                    $this->hollowing=$value;
                    break;
                case "transactionstatus":
                    $this->transactionStatus=$value;
                    break;
                case "actioncode":
                    $this->actionCode=$value;
                    break;
                case "errorassocarray":
                    $this->errorAssocArray=$value;
                    break;
                case "dataexistsstatus":
                    $this->dataExistsStatus=$value;
            }
        }
    }
    
    //override the getArray method in Parent class
    //return: Array
    public function getArray():array {
        //create array to contain business objects data
        $arr=array();
        $i=0;   //count of number of Object parameters read into array.
        foreach($this as $key => $value){
            if($i<$this->getObjectNumOfFields()){
                $arr[$key]=$value;
                $i++;
            }
        }
        return $arr;
    }
    //override the getArray method in Parent class
    public function setObjectParameters(array $arr) {
        $i=0;   //counter of number of objects read from array into object
        foreach ($this as $key => &$value){
            if($i<$this->getObjectNumOfFields()){
                $value=$arr[$key];
                $i++;
            }
        }
    }
   
}

