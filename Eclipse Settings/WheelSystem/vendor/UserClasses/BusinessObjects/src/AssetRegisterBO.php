<?php
namespace UserClasses\BusinessObjects;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class AssetRegisterBO extends BusinessObject
{
    private $assetID=0;
    private $coachDetails2DArray;
    private $coachNumber="";
    private $staffNumber="";
    private $numRecordsFound=0;
    
    /**
     */
    public function __construct()
    {
        $this->setObjectNumOfFields(9);
    }
    
    /**
     * @return number
     */
    public function getNumRecordsFound()
    {
        return $this->numRecordsFound;
    }

    /**
     * @param number $numRecordsFound
     */
    public function setNumRecordsFound($numRecordsFound)
    {
        $this->numRecordsFound = $numRecordsFound;
    }

      
    /**
     * @return number
     */
    public function getAssetID()
    {
        return $this->assetID;
    }

    /**
     * @return mixed
     */
    public function getCoachDetails2DArray()
    {
        return $this->coachDetails2DArray;
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
     * @param number $assetID
     */
    public function setAssetID($assetID)
    {
        $this->assetID = $assetID;
    }

    /**
     * @param mixed $coachDetails2DArray
     */
    public function setCoachDetails2DArray($coachDetails2DArray)
    {
        $this->coachDetails2DArray = $coachDetails2DArray;
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

    public function set(array $data){
        
        foreach($data as $key => $value){
            //make the Key case insensitive by making the string comparison to be lower case
            $key_lower=strtolower($key);
            switch($key_lower){
                case "numrecordsfound":
                    $this->numRecordsFound=$value;
                    break;
                case "assetid":
                    $this->assetID=$value;
                    break;
                case "coachdetails2darray":
                    $this->coachDetails2DArray=$value;
                    break;
                case "coachnumber":
                    $this->coachNumber=$value;
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
