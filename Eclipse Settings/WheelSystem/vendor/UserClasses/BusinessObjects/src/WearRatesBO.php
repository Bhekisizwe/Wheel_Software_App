<?php
declare(strict_types=1);
namespace UserClasses\BusinessObjects;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class WearRatesBO extends BusinessObject
{
    private $wearRate2DArray;
    private $staffNumber="";
    
    /**
     */
    public function __construct()
    {
        $this->setObjectNumOfFields(6);
    }
    
    /**
     * @return Ambigous <string, unknown>
     */
    public function getStaffNumber()
    {
        return $this->staffNumber;
    }

    /**
     * @param Ambigous <string, unknown> $staffNumber
     */
    public function setStaffNumber($staffNumber)
    {
        $this->staffNumber = $staffNumber;
    }
    
    /**
     * @return mixed
     */
    public function getWearRate2DArray()
    {
        return $this->wearRate2DArray;
    }

    /**
     * @param mixed $wearRate2DArray
     */
    public function setWearRate2DArray($wearRate2DArray)
    {
        $this->wearRate2DArray = $wearRate2DArray;
    }
    
    public function set(array $data){
        
        foreach($data as $key => $value){
            //make the Key case insensitive by making the string comparison to be lower case
            $key_lower=strtolower($key);
            switch($key_lower){
                case "staffnumber":
                    $this->staffNumber=$value;
                    break;                
                case "wearrate2darray":
                    $this->wearRate2DArray=$value;
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

