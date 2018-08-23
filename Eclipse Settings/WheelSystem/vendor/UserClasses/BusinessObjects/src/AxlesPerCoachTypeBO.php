<?php
declare(strict_types=1);
namespace UserClasses\BusinessObjects;

use UserClasses\BusinessObjects\BusinessObject;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class AxlesPerCoachTypeBO extends BusinessObject
{
    private $axlesID=0;
    private $coachID=0;
    private $numberOfAxles=0;
    private $coachType="";
    private $coachCategory="";
    private $staffNumber="";
    
    /**
     */
    public function __construct()
    {
        $this->setObjectNumOfFields(10);
    }
    
    /**
     * @return number
     */
    public function getAxlesID()
    {
        return $this->axlesID;
    }

    /**
     * @return number
     */
    public function getCoachID()
    {
        return $this->coachID;
    }

    /**
     * @return number
     */
    public function getNumberOfAxles()
    {
        return $this->numberOfAxles;
    }

    /**
     * @return string
     */
    public function getCoachType()
    {
        return $this->coachType;
    }

    /**
     * @return string
     */
    public function getCoachCategory()
    {
        return $this->coachCategory;
    }

    /**
     * @return string
     */
    public function getStaffNumber()
    {
        return $this->staffNumber;
    }

    /**
     * @param number $axlesID
     */
    public function setAxlesID($axlesID)
    {
        $this->axlesID = $axlesID;
    }

    /**
     * @param number $coachID
     */
    public function setCoachID($coachID)
    {
        $this->coachID = $coachID;
    }

    /**
     * @param number $numberOfAxles
     */
    public function setNumberOfAxles($numberOfAxles)
    {
        $this->numberOfAxles = $numberOfAxles;
    }

    /**
     * @param string $coachType
     */
    public function setCoachType($coachType)
    {
        $this->coachType = $coachType;
    }

    /**
     * @param string $coachCategory
     */
    public function setCoachCategory($coachCategory)
    {
        $this->coachCategory = $coachCategory;
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
                case "staffnumber":
                    $this->staffNumber=$value;
                    break;
                case "axlesid":
                    $this->axlesID=$value;
                    break;
                case "coachid":
                    $this->coachID=$value;
                    break;
                case "numberofaxles":
                    $this->numberOfAxles=$value;
                    break;
                case "coachtype":
                    $this->coachType=$value;
                    break;
                case "coachcategory":
                    $this->coachCategory=$value;
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

