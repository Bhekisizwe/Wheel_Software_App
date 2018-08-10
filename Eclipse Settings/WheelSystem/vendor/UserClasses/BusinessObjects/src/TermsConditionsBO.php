<?php
namespace UserClasses\BusinessObjects;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class TermsConditionsBO extends BusinessObject
{
    private $termsID=0;
    private $licenseID=0;
    private $companyName="";
    private $postalAddressArray;
    private $terms="";
    private $dateModified="";
    
    /**
     * @return number
     */
    public function getTermsID()
    {
        return $this->termsID;
    }

    /**
     * @return Ambigous <number, unknown>
     */
    public function getLicenseID()
    {
        return $this->licenseID;
    }

    /**
     * @return Ambigous <string, unknown>
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return mixed
     */
    public function getPostalAddressArray()
    {
        return $this->postalAddressArray;
    }

    /**
     * @return Ambigous <string, unknown>
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @return Ambigous <string, unknown>
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * @param number $termsID
     */
    public function setTermsID($termsID)
    {
        $this->termsID = $termsID;
    }

    /**
     * @param Ambigous <number, unknown> $licenseID
     */
    public function setLicenseID($licenseID)
    {
        $this->licenseID = $licenseID;
    }

    /**
     * @param Ambigous <string, unknown> $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @param mixed $postalAddressArray
     */
    public function setPostalAddressArray($postalAddressArray)
    {
        $this->postalAddressArray = $postalAddressArray;
    }

    /**
     * @param Ambigous <string, unknown> $terms
     */
    public function setTerms($terms)
    {
        $this->terms = $terms;
    }

    /**
     * @param Ambigous <string, unknown> $dateModified
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;
    }

    public function set(array $data){
        
        foreach($data as $key => $value){
            //make the Key case insensitive by making the string comparison to be lower case
            $key_lower=strtolower($key);
            switch($key_lower){
                case "termsid":
                    $this->termsID=$value;
                    break;
                case "licenseid":
                    $this->licenseID=$value;
                    break;
                case "postaladdressarray":
                    $this->postalAddressArray=$value;
                    break;
                case "companyname":
                    $this->companyName=$value;
                    break;
                case "terms":
                    $this->terms=$value;
                    break;
                case "datemodified":
                    $this->dateModified=$value;
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

