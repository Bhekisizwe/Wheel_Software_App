<?php
declare(strict_types=1);
namespace UserClasses\BusinessObjects;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class AxleCoachMappingBO extends BusinessObject
{
    private $mappingID=0;
    private $axleSerialNumber="";
    private $axleNumber=0;
    private $setNumber="";
    private $coachNumber="";
    private $staffNumber="";
    private $startDate="";
    private $endDate="";
    private $dateCreated="";
    
    /**
     */
    public function __construct()
    {
        $this->setObjectNumOfFields(13);
    }

    /**
     * @return number
     */
    public function getMappingID()
    {
        return $this->mappingID;
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
    public function getAxleNumber()
    {
        return $this->axleNumber;
    }

    /**
     * @return string
     */
    public function getSetNumber()
    {
        return $this->setNumber;
    }

    /**
     * @return string
     */
    public function getCoachNumber()
    {
        return $this->coachNumber;
    }

    /**
     * @return string
     */
    public function getStaffNumber()
    {
        return $this->staffNumber;
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
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param number $mappingID
     */
    public function setMappingID($mappingID)
    {
        $this->mappingID = $mappingID;
    }

    /**
     * @param string $axleSerialNumber
     */
    public function setAxleSerialNumber($axleSerialNumber)
    {
        $this->axleSerialNumber = $axleSerialNumber;
    }

    /**
     * @param number $axleNumber
     */
    public function setAxleNumber($axleNumber)
    {
        $this->axleNumber = $axleNumber;
    }

    /**
     * @param string $setNumber
     */
    public function setSetNumber($setNumber)
    {
        $this->setNumber = $setNumber;
    }

    /**
     * @param string $coachNumber
     */
    public function setCoachNumber($coachNumber)
    {
        $this->coachNumber = $coachNumber;
    }

    /**
     * @param string $staffNumber
     */
    public function setStaffNumber($staffNumber)
    {
        $this->staffNumber = $staffNumber;
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
     * @param string $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }
    
    public function set(array $data){
        
        foreach($data as $key => $value){
            //make the Key case insensitive by making the string comparison to be lower case
            $key_lower=strtolower($key);
            switch($key_lower){
                case "mappingid":
                    $this->mappingID=$value;
                    break;
                case "axleserialnumber":
                    $this->axleSerialNumber=$value;
                    break;
                case "axlenumber":
                    $this->axleNumber=$value;
                    break;
                case "setnumber":
                    $this->setNumber=$value;
                    break;
                case "coachnumber":
                    $this->coachNumber=$value;
                    break;
                case "staffnumber":
                    $this->staffNumber=$value;
                    break;
                case "startdate":
                    $this->startDate=$value;
                    break;
                case "enddate":
                    $this->endDate=$value;
                    break;
                case "datecreated":
                    $this->dateCreated=$value;
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

