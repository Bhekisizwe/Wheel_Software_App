<?php
declare(strict_types=1);
namespace UserClasses\DataLayer;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class ManualWheelSettingsDL extends DatabaseManager implements DatabaseFunctionsInt
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
            /*********RETRIEVE WheelParameters from Database*************/
            $query="SELECT ParamID FROM WheelParameters WHERE ParamName=?";
            $stmt=$connector->prepare($query);
            $paramName=$data["paramName"];
            $stmt->bind_param("s",$paramName);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($ParamID);
            if($status){
                $arr=array();   //array to store result set
                while($stmt->fetch()){
                    $arr["paramID"]=$ParamID;
                }
                $this->dbClose($connector);
                return (int) $arr["paramID"];
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
            /***INSERT Manual Wheel Measurements Settings Data into Database*******/
            $query="INSERT INTO WarningSettings";
            $query.=" (SettingsID,WarningLevel,ParamID) ";
            $query.="VALUES ('',?,?)";
            //prepare SQL script for execution
            $stmt=$connector->prepare($query);
            //bind parameters
            for($i=0;$i<count($data["warning2DArray"]);$i++){
                //loop through array contents
                $paramID=$this->getPrimaryKey($data["warning2DArray"][$i]);
                $warningLevel=$data["warning2DArray"][$i]["warningLevel"];
                $stmt->bind_param("di",$warningLevel,$paramID);
                $status_message=$stmt->execute();
            }
            $this->dbClose($connector);
            return $status_message;
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
            /***UPDATE Manual Wheel Measurements Warning Levels Data in Database*******/
            $query="UPDATE WarningSettings SET WarningLevel=? WHERE SettingsID=?";
            $stmt=$connector->prepare($query);
            //bind parameters
            for($i=0;$i<count($data["warning2DArray"]);$i++){
                $warningLevel=$data["warning2DArray"][$i]["warningLevel"];
                $settingsID=$data["warning2DArray"][$i]["settingsID"];
                $stmt->bind_param("di",$warningLevel,$settingsID);
                $status_message=$stmt->execute();
            }
            $this->dbClose($connector); //Close Database Connection
            return $status_message;
        }
        else return false; 
    }

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::dataExists()
     */
    public function dataExists(array $data):bool
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::delete()
     */
    public function delete(array $data):bool
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            $query="DELETE FROM WarningSettings";
            $status_message=$connector->query($query);
            $query="ALTER TABLE WarningSettings AUTO_INCREMENT=0";
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
            /*********RETRIEVE Manual Wheel Measurements Settings from Database*************/
            $query="SELECT * FROM WarningSettings,WheelParameters WHERE WarningSettings.ParamID=WheelParameters.ParamID";
            $result=$connector->query($query);
            if($result){
                $arr_2D=array();   //array to store result set
                $i=0;   //row counter
                while($rows=$result->fetch_assoc()){
                    $arr["settingsID"]=$rows["SettingsID"];
                    $arr["paramID"]=$rows["ParamID"];
                    $arr["warningLevel"]=$rows["WarningLevel"];
                    $arr["paramName"]=$rows["ParamName"];
                    $arr_2D["warning2DArray"][$i++]=$arr; //fetch each row
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
    
    public function retrieveAllParameters():array {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*********RETRIEVE ALL Parameter Names from Database*************/
            $query="SELECT * FROM WheelParameters ORDER BY ParamID Asc LIMIT 4,5";
            $result=$connector->query($query);
            if($result){
                $arr_2D=array();
                $i=0;
                while($rows=$result->fetch_assoc()){
                    $arr["paramID"]=$rows["ParamID"];
                    $arr["paramName"]=$rows["ParamName"];
                    $arr_2D["warning2DArray"][$i++]=$arr;
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

