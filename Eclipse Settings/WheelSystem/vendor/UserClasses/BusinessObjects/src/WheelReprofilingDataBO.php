<?php
declare(strict_types=1);
namespace UserClasses\BusinessObjects;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class WheelReprofilingDataBO extends BusinessObject
{
    private $reprofilingID=0;
    private $axleSerialNumber="";
    private $initialLeftDiameter=0.0;
    private $initialRightDiameter=0.0;
    private $finalLeftDiameter=0.0;
    private $finalRightDiameter=0.0;
    private $costOfService=0.0;
    private $dateOfService="";
    private $serviceProviderName="";
    private $leftWheelCutLength=0.0;
    private $rightWheelCutLength=0.0;
    private $startDate="";
    private $endDate="";
    private $staffNumber="";
    
    /**
     */
    public function __construct()
    {
        $this->setObjectNumOfFields(18);
    }
    
    /**
     * @return number
     */
    public function getReprofilingID()
    {
        return $this->reprofilingID;
    }

    /**
     * @return string
     */
    public function getAxleSerialNumber()
    {
        return $this->axleSerialNumber;
    }

    /**
     * @return number
     */
    public function getInitialLeftDiameter()
    {
        return $this->initialLeftDiameter;
    }

    /**
     * @return number
     */
    public function getInitialRightDiameter()
    {
        return $this->initialRightDiameter;
    }

    /**
     * @return number
     */
    public function getFinalLeftDiameter()
    {
        return $this->finalLeftDiameter;
    }

    /**
     * @return number
     */
    public function getFinalRightDiameter()
    {
        return $this->finalRightDiameter;
    }

    /**
     * @return number
     */
    public function getCostOfService()
    {
        return $this->costOfService;
    }

    /**
     * @return string
     */
    public function getDateOfService()
    {
        return $this->dateOfService;
    }

    /**
     * @return string
     */
    public function getServiceProviderName()
    {
        return $this->serviceProviderName;
    }

    /**
     * @return number
     */
    public function getLeftWheelCutLength()
    {
        return $this->leftWheelCutLength;
    }

    /**
     * @return number
     */
    public function getRightWheelCutLength()
    {
        return $this->rightWheelCutLength;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return string
     */
    public function getStaffNumber()
    {
        return $this->staffNumber;
    }

    /**
     * @param number $reprofilingID
     */
    public function setReprofilingID($reprofilingID)
    {
        $this->reprofilingID = $reprofilingID;
    }

    /**
     * @param string $axleSerialNumber
     */
    public function setAxleSerialNumber($axleSerialNumber)
    {
        $this->axleSerialNumber = $axleSerialNumber;
    }

    /**
     * @param number $initialLeftDiameter
     */
    public function setInitialLeftDiameter($initialLeftDiameter)
    {
        $this->initialLeftDiameter = $initialLeftDiameter;
    }

    /**
     * @param number $initialRightDiameter
     */
    public function setInitialRightDiameter($initialRightDiameter)
    {
        $this->initialRightDiameter = $initialRightDiameter;
    }

    /**
     * @param number $finalLeftDiameter
     */
    public function setFinalLeftDiameter($finalLeftDiameter)
    {
        $this->finalLeftDiameter = $finalLeftDiameter;
    }

    /**
     * @param number $finalRightDiameter
     */
    public function setFinalRightDiameter($finalRightDiameter)
    {
        $this->finalRightDiameter = $finalRightDiameter;
    }

    /**
     * @param number $costOfService
     */
    public function setCostOfService($costOfService)
    {
        $this->costOfService = $costOfService;
    }

    /**
     * @param string $dateOfService
     */
    public function setDateOfService($dateOfService)
    {
        $this->dateOfService = $dateOfService;
    }

    /**
     * @param string $serviceProviderName
     */
    public function setServiceProviderName($serviceProviderName)
    {
        $this->serviceProviderName = $serviceProviderName;
    }

    /**
     * @param number $leftWheelCutLength
     */
    public function setLeftWheelCutLength($leftWheelCutLength)
    {
        $this->leftWheelCutLength = $leftWheelCutLength;
    }

    /**
     * @param number $rightWheelCutLength
     */
    public function setRightWheelCutLength($rightWheelCutLength)
    {
        $this->rightWheelCutLength = $rightWheelCutLength;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @param string $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @param string $staffNumber
     */
    public function setStaffNumber($staffNumber)
    {
        $this->staffNumber = $staffNumber;
    }
 
    public function set(array $data){
        
        foreach($data as $key => $value){
            //make the Key case insensitive by making the string comparison to be lower case
            $key_lower=strtolower($key);
            switch($key_lower){               
                case "reprofilingid":
                    $this->reprofilingID=$value;
                    break;
                case "staffnumber":
                    $this->staffNumber=$value;
                    break;
                case "axleserialnumber":
                    $this->axleSerialNumber=$value;
                    break;
                case "initialleftdiameter":
                    $this->initialLeftDiameter=$value;
                    break;
                case "initialrightdiameter":
                    $this->initialRightDiameter=$value;
                    break;
                case "finalleftdiameter":
                    $this->finalLeftDiameter=$value;
                    break;
                case "finalrightdiameter":
                    $this->finalRightDiameter=$value;
                    break;
                case "costofservice":
                    $this->costOfService=$value;
                    break;
                case "dateofservice":
                    $this->dateOfService=$value;
                    break;
                case "serviceprovidername":
                    $this->serviceProviderName=$value;
                    break;
                case "leftwheelcutlength":
                    $this->leftWheelCutLength=$value;
                    break;
                case "rightwheelcutlength":
                    $this->rightWheelCutLength=$value;
                    break;
                case "startdate":
                    $this->startDate=$value;
                    break;
                case "enddate":
                    $this->endDate=$value;
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
