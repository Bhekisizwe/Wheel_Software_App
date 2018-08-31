<?php
declare(strict_types=1);
namespace UserClasses\BusinessObjects;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class AutoWheelSettingsBO extends ManualWheelSettingsBO
{
    private $alarms2DArray;
    
    /**
     */
    public function __construct()
    {
        parent::__construct();
        $this->setObjectNumOfFields(7);
    }

    /**
     * @return mixed
     */
    public function getAlarms2DArray()
    {
        return $this->alarms2DArray;
    }

    /**
     * @param mixed $alarms2DArray
     */
    public function setAlarms2DArray($alarms2DArray)
    {
        $this->alarms2DArray = $alarms2DArray;
    } 
    
    public function set(array $data){
        
        foreach($data as $key => $value){
            //make the Key case insensitive by making the string comparison to be lower case
            $key_lower=strtolower($key);
            switch($key_lower){
                case "staffnumber":
                    $this->staffNumber=$value;
                    break;               
                case "warning2darray":
                    $this->warning2DArray=$value;
                    break;
                case "alarms2darray":
                    $this->alarms2DArray=$value;
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
