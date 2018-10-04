<?php
declare(strict_types=1);
namespace UserClasses\DataLayer;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class AssetRegisterDL extends DatabaseManager implements DatabaseFunctionsInt
{

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::getPrimaryKey()
     */
    public function getPrimaryKey(array $data):int
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*********RETRIEVE Coach Details Data from Database*************/
            $query="SELECT CoachID FROM CoachDetails WHERE CoachType=?";
            $stmt=$connector->prepare($query);
            $coachType=$data["coachDetails2DArray"][0]["coachType"];
            $stmt->bind_param("s",$coachType);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($coachID);
            if($status){
                $arr=array();   //array to store result set
                while($stmt->fetch()){                    
                    //do nothing                    
                }
                $this->dbClose($connector);
                return (int) $coachID;                
            }
            else{
                $this->dbClose($connector);
                return 0;
            }
        }
        else return 0;
    }
    
    public function getCoachIDFromCoachNumber(array $data):int
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*********RETRIEVE CoachID Data from Database*************/
            $query="SELECT CoachID FROM AssetRegister WHERE CoachNumber=?";
            $stmt=$connector->prepare($query);
            $coachNumber=$data["coachNumber"];
            $stmt->bind_param("s",$coachNumber);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($coachID);
            if($status){
                $arr=array();   //array to store result set
                while($stmt->fetch()){
                    //do nothing
                }
                $this->dbClose($connector);
                return (int) $coachID;
            }
            else{
                $this->dbClose($connector);
                return 0;
            }
        }
        else return 0;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::create()
     */
    public function create(array $data):bool
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            //successfully connected to database
            /***INSERT CoachDetails, AssetRegister Data into Database*******/
            //first check if CoachType already exists in database.
            if(!$this->checkCoachTypeExists($data)){
                //it doesn't exist so we must add it.
                $query="INSERT INTO CoachDetails";
                $query.=" (CoachID,CoachType,CoachCategory) VALUES ('',?,?)";
                //prepare SQL script for execution
                $stmt=$connector->prepare($query);
                //bind parameters
                $coachType=$data["coachDetails2DArray"][0]["coachType"];
                $coachCategory=$data["coachDetails2DArray"][0]["coachCategory"];
                $stmt->bind_param("ss",$coachType,$coachCategory);
                $status_message=$stmt->execute();
            }
            else $status_message=true;
            
            if($status_message){
                //successfully added the CoachType. Let us get the Primary Key of this last added role
                $coachID=$this->getPrimaryKey($data);
                //let us insert the Access Rights for this role
                $query="INSERT INTO AssetRegister (AssetID,CoachNumber,CoachID)";
                $query.=" VALUES('',?,?)";
                //prepare SQL script for execution
                $stmt=$connector->prepare($query);
                //bind parameters
                $coachNumber=$data["coachNumber"];                
                $stmt->bind_param("si",$coachNumber,$coachID);
                $status_message=$stmt->execute();        
                $this->dbClose($connector); //Close Database Connection
                return $status_message;
            }
            $this->dbClose($connector); //Close Database Connection
            return $status_message;
        }
        else return false;
    }
    
    private function checkCoachTypeExists(array $data):bool {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*****Check if CoachType already exists in Database*******/
            $query="SELECT CoachID FROM CoachDetails WHERE CoachType=?";
            $stmt=$connector->prepare($query);
            $coachType=$data["coachDetails2DArray"][0]["coachType"];
            $stmt->bind_param("s",$coachType);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($coachid);
            if($status){
                ($stmt->num_rows>0)?$status_message=true:$status_message=false;
                $this->dbClose($connector);
                return $status_message;
            }
            else{
                $this->dbClose($connector);
                return false;
            }
        }
        else return false;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::update()
     */
    public function update(array $data):bool
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /***UPDATE Coach Details and/Or Asset Register in Database*******/
            //check if coachtype already exists in system
            if($this->checkCoachTypeExists($data)){
                //yes new coachtype exists in system. Re-assign CoachID to AssetRegister data
                //update Asset Register
                $query="UPDATE AssetRegister SET CoachNumber=?,CoachID=? WHERE AssetID=?";
                //prepare SQL script for execution
                $stmt=$connector->prepare($query);
                //bind parameters
                $coachNumber=$data["coachNumber"];
                $coachID=$this->getPrimaryKey($data);
                $assetID=$data["assetID"];
                $stmt->bind_param("sii",$coachNumber,$coachID,$assetID);
                $status_message=$stmt->execute();
		$query="UPDATE CoachDetails SET CoachCategory=? WHERE CoachID=?";
		//prepare SQL script for execution
                $stmt=$connector->prepare($query);
                //bind parameters                
                $coachCategory=$data["coachDetails2DArray"][0]["coachCategory"];
                $stmt->bind_param("si",$coachCategory,$coachID);
                $status_message=$stmt->execute();
                $this->dbClose($connector); //Close Database Connection
                return $status_message;
            }
            else{
                //it doesnt exist so add it
                $query="INSERT INTO CoachDetails";
                $query.=" (CoachID,CoachType,CoachCategory) VALUES ('',?,?)";
                //prepare SQL script for execution
                $stmt=$connector->prepare($query);
                //bind parameters
                $coachType=$data["coachDetails2DArray"][0]["coachType"];
                $coachCategory=$data["coachDetails2DArray"][0]["coachCategory"];
                $stmt->bind_param("ss",$coachType,$coachCategory);
                $status_message=$stmt->execute();
                if($status_message){
                    //successfully added the CoachType. Let us get the Primary Key of this last added CoachType
                    $coachID=$this->getPrimaryKey($data);
                    //let us insert the Access Rights for this role
                    $query="UPDATE AssetRegister SET CoachNumber=?,CoachID=? WHERE AssetID=?";
                    //prepare SQL script for execution
                    $stmt=$connector->prepare($query);
                    //bind parameters
                    $coachNumber=$data["coachNumber"];                    
                    $assetID=$data["assetID"];
                    $stmt->bind_param("sii",$coachNumber,$coachID,$assetID);
                    $status_message=$stmt->execute();                 
                }
                $this->dbClose($connector); //Close Database Connection
                return $status_message;
            }             
        }
        else return false; 
    }

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::dataExists()
     */
    public function dataExists(array $data):bool
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*****Check if CoachNumber already exists in Database*******/
            $query="SELECT AssetID FROM AssetRegister WHERE CoachNumber=?";
            $stmt=$connector->prepare($query);
            $coachNumber=$data["coachNumber"];
            $stmt->bind_param("s",$coachNumber);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($assetid);
            if($status){
                ($stmt->num_rows>0)?$status_message=true:$status_message=false;
                $this->dbClose($connector);
                return $status_message;
            }
            else{
                $this->dbClose($connector);
                return false;
            }
        }
        else return false;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::delete()
     */
    public function delete(array $data):bool
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            $query="DELETE FROM CoachDetails";
            $status_message=$connector->query($query);
            $query="ALTER TABLE CoachDetails AUTO_INCREMENT =0";
            $status_message=$connector->query($query);
            $query="ALTER TABLE AssetRegister AUTO_INCREMENT =0";
            $status_message=$connector->query($query);
            $this->dbClose($connector);
            return $status_message;
        }
        else return false;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::searchData()
     */
    public function searchData(array $data):array
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*********RETRIEVE CoachDetails,AssetRegister profile Data from Database*************/
            $query="SELECT AssetRegister.AssetID,AssetRegister.CoachNumber,CoachDetails.CoachID,";
            $query.="CoachDetails.CoachType,CoachDetails.CoachCategory ";
            $query.="FROM AssetRegister,CoachDetails";
            $query.=" WHERE AssetRegister.CoachNumber=? AND AssetRegister.CoachID=CoachDetails.CoachID LIMIT 1";
            $stmt=$connector->prepare($query);
            $coachNumber=$data["coachNumber"];
            $stmt->bind_param("s",$coachNumber);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($assetID,$coachnumber,$coachID,$coachtype,$coachcategory);
            if($status){
                $arr=array();   //array to store result set
                while($stmt->fetch()){
                    $arr["assetID"]=$assetID;
                    $arr["coachNumber"]=$coachnumber;
                    $arr["coachDetails2DArray"][0]["coachID"]=$coachID;
                    $arr["coachDetails2DArray"][0]["coachType"]=$coachtype;
                    $arr["coachDetails2DArray"][0]["coachCategory"]=$coachcategory;                   
                }
                $this->dbClose($connector);
                return $arr;
            }
            else{
                $this->dbClose($connector);
                return NULL;
            }
        }
        else return NULL;
    }
    
    public function retrieveAllCoachTypes():array {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*********RETRIEVE ALL Coach Types from Database*************/
            $query="SELECT * FROM CoachDetails ORDER BY CoachType Asc";
            $result=$connector->query($query);
            if($result){
                $arr_2D=array();
                $i=0;
                while($rows=$result->fetch_assoc()){
                    $arr["coachID"]=$rows["CoachID"];
                    $arr["coachType"]=$rows["CoachType"];
                    $arr["coachCategory"]=$rows["CoachCategory"];
                    $arr_2D["coachDetails2DArray"][$i++]=$arr;
                }
                $this->dbClose($connector);
                return $arr_2D;
            }
            else{
                $this->dbClose($connector);
                return NULL;
            }
        }
        else return NULL;
    }
}

