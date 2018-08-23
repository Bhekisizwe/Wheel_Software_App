<?php
declare(strict_types=1);
namespace UserClasses\BusinessObjects;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class DailyDistanceSettingBO extends BusinessObject
{
    private $distanceID=0;
    private $distance=0.0;
    private $staffNumber="";
    
    /**
     */
    public function __construct()
    {
        $this->setObjectNumOfFields(7);
    }
    
    /**
     * @return number
     */
    public function getDistanceID()
    {
        return $this->distanceID;
    }

    /**
     * @return number
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @return string
     */
    public function getStaffNumber()
    {
        return $this->staffNumber;
    }

    /**
     * @param number $distanceID
     */
    public function setDistanceID($distanceID)
    {
        $this->distanceID = $distanceID;
    }

    /**
     * @param number $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
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
                case "distanceid":
                    $this->distanceID=$value;
                    break;
                case "distance":
                    $this->distance=$value;
                    break;
                case "staffnumber":
                    $this->staffNumber=$value;
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

