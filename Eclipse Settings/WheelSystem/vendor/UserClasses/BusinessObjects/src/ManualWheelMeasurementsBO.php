<?php
declare(strict_types=1);
namespace UserClasses\BusinessObjects;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class ManualWheelMeasurementsBO extends MiniProfMeasurementsBO
{
    protected $manualID=0;
    protected $spreadRim=0.0;
    protected $wheelSkid=0.0;
    protected $cutTyreWidth=0.0;
    protected $cutTyreDepth=0.0;
    protected $cutTyreDistanceFromFlange=0.0;
    protected $reportStartDate="";
    protected $reportEndDate="";
    protected $gibsonDescription="";
    
    /**
     */
    public function __construct()
    {
        parent::__construct();
        $this->setObjectNumOfFields(26);
    }
    
    /**
     * @return string
     */
    public function getGibsonDescription()
    {
        return $this->gibsonDescription;
    }

    /**
     * @param string $gibsonDescription
     */
    public function setGibsonDescription($gibsonDescription)
    {
        $this->gibsonDescription = $gibsonDescription;
    }    
    
    /**
     * @return number
     */
    public function getManualID()
    {
        return $this->manualID;
    }

    /**
     * @return number
     */
    public function getSpreadRim()
    {
        return $this->spreadRim;
    }

    /**
     * @return number
     */
    public function getWheelSkid()
    {
        return $this->wheelSkid;
    }

    /**
     * @return number
     */
    public function getCutTyreWidth()
    {
        return $this->cutTyreWidth;
    }

    /**
     * @return number
     */
    public function getCutTyreDepth()
    {
        return $this->cutTyreDepth;
    }

    /**
     * @return number
     */
    public function getCutTyreDistanceFromFlange()
    {
        return $this->cutTyreDistanceFromFlange;
    }

    /**
     * @return string
     */
    public function getReportStartDate()
    {
        return $this->reportStartDate;
    }

    /**
     * @return string
     */
    public function getReportEndDate()
    {
        return $this->reportEndDate;
    }

    /**
     * @param number $manualID
     */
    public function setManualID($manualID)
    {
        $this->manualID = $manualID;
    }

    /**
     * @param number $spreadRim
     */
    public function setSpreadRim($spreadRim)
    {
        $this->spreadRim = $spreadRim;
    }

    /**
     * @param number $wheelSkid
     */
    public function setWheelSkid($wheelSkid)
    {
        $this->wheelSkid = $wheelSkid;
    }

    /**
     * @param number $cutTyreWidth
     */
    public function setCutTyreWidth($cutTyreWidth)
    {
        $this->cutTyreWidth = $cutTyreWidth;
    }

    /**
     * @param number $cutTyreDepth
     */
    public function setCutTyreDepth($cutTyreDepth)
    {
        $this->cutTyreDepth = $cutTyreDepth;
    }

    /**
     * @param number $cutTyreDistanceFromFlange
     */
    public function setCutTyreDistanceFromFlange($cutTyreDistanceFromFlange)
    {
        $this->cutTyreDistanceFromFlange = $cutTyreDistanceFromFlange;
    }

    /**
     * @param string $reportStartDate
     */
    public function setReportStartDate($reportStartDate)
    {
        $this->reportStartDate = $reportStartDate;
    }

    /**
     * @param string $reportEndDate
     */
    public function setReportEndDate($reportEndDate)
    {
        $this->reportEndDate = $reportEndDate;
    }

    public function set(array $data){
        
        foreach($data as $key => $value){
            //make the Key case insensitive by making the string comparison to be lower case
            $key_lower=strtolower($key);
            switch($key_lower){
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

