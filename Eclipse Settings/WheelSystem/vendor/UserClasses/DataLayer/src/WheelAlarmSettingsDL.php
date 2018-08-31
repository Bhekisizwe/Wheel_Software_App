<?php
declare(strict_types=1);
namespace UserClasses\DataLayer;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class WheelAlarmSettingsDL extends DatabaseManager implements DatabaseFunctionsInt
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
            /*********RETRIEVE SettingsID from Database*************/
            $query="SELECT SettingsID FROM WarningSettings WHERE ParamID=? ORDER BY SettingsID Desc LIMIT 1";
            $stmt=$connector->prepare($query);
            $paramID=$data["warning2DArray"][0]["paramID"];
            $stmt->bind_param("i",$paramID);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($settingsID);
            if($status){
                $arr=array();   //array to store result set
                while($stmt->fetch()){
                    $arr["warning2DArray"][0]["settingsID"]=$settingsID;
                }
                $this->dbClose($connector);
                return (int) $arr["warning2DArray"][0]["settingsID"];
            }
            else{
                $this->dbClose($connector);
                return 0;
            }
        }
        else return 0;
    }
    
    public function getParamID(array $data):int {
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
            /***INSERT WarningSettings, AlarmSettings Data into Database*******/
                    
            $query="INSERT INTO WarningSettings";
            $query.=" (SettingsID,WarningLevel,ParamID) ";
            $query.="VALUES ('',?,?)";
            //prepare SQL script for execution
            $stmt=$connector->prepare($query);
            //bind parameters
            for($i=0;$i<count($data["warning2DArray"]);$i++){
                //loop through array contents
                $paramID=$this->getParamID($data["warning2DArray"][$i]);
                $warningLevel=$data["warning2DArray"][$i]["warningLevel"];
                $stmt->bind_param("di",$warningLevel,$paramID);
                $status_message=$stmt->execute();
            }
          
            if($status_message){
                //successfully added the Warning Settings.
               //let us insert the Alarm Settings
                $query="INSERT INTO AlarmSettings (AlarmID,SettingsID,CoachID,AlarmLevel,NorminalLevel)";
                $query.=" VALUES('',?,?,?,?)";
                //prepare SQL script for execution
                $stmt=$connector->prepare($query);
                //bind parameters
                for($i=0;$i<count($data["alarms2DArray"]);$i++){
                    //loop through array contents
                    $paramID=$this->getParamID($data["warning2DArray"][$i]);
                    $data["warning2DArray"][0]["paramID"]=$paramID;
                    $settingsID=$this->getPrimaryKey($data);
                    $alarmLevel=$data["alarms2DArray"][$i]["alarmLevel"];
                    $norminalLevel=$data["alarms2DArray"][$i]["norminalLevel"];
                    $coachID=$data["alarms2DArray"][$i]["coachID"];
                    $stmt->bind_param("iidd",$settingsID,$coachID,$alarmLevel,$norminalLevel);
                    $status_message=$stmt->execute();
                }
                $this->dbClose($connector); //Close Database Connection
                return $status_message;
            }
            $this->dbClose($connector); //Close Database Connection
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
            /***UPDATE Warning and Alarm Levels Data in Database*******/
            $query="UPDATE WarningSettings SET WarningLevel=? WHERE SettingsID=?";
            $stmt=$connector->prepare($query);
            //bind parameters
            for($i=0;$i<count($data["warning2DArray"]);$i++){
                $warningLevel=$data["warning2DArray"][$i]["warningLevel"];
                $settingsID=$data["warning2DArray"][$i]["settingsID"];
                $stmt->bind_param("di",$warningLevel,$settingsID);
                $status_message=$stmt->execute();
            }
            $query="UPDATE AlarmSettings SET AlarmLevel=?,NorminalLevel=? WHERE SettingsID=?";
            $stmt=$connector->prepare($query);
            //bind parameters
            for($i=0;$i<count($data["alarms2DArray"]);$i++){
                $alarmLevel=$data["alarms2DArray"][$i]["alarmLevel"];
                $norminalLevel=$data["alarms2DArray"][$i]["norminalLevel"];
                $settingsID=$data["warning2DArray"][$i]["settingsID"];
                $stmt->bind_param("ddi",$alarmLevel,$norminalLevel,$settingsID);
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
            $query="ALTER TABLE AlarmSettings AUTO_INCREMENT=0";
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
            /*********RETRIEVE MiniProf and Manual Wheel Measurements Settings from Database*************/
            $query="SELECT AlarmSettings.AlarmID,AlarmSettings.SettingsID,AlarmSettings.AlarmLevel,";
            $query.="AlarmSettings.NorminalLevel,WarningSettings.WarningLevel,WarningSettings.ParamID,";
            $query.="WheelParameters.ParamName FROM AlarmSettings,WarningSettings,WheelParameters ";
            $query.="WHERE (WarningSettings.ParamID=WheelParameters.ParamID";
            $query.=" AND AlarmSettings.SettingsID=WarningSettings.SettingsID) AND AlarmSettings.CoachID=?";
            $stmt=$connector->prepare($query);
            $coachID=$data["alarms2DArray"][0]["coachID"];
            $stmt->bind_param("i",$coachID);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($alarmID,$settingsID,$alarmLevel,$norminalLevel,$warningLevel,$paramID,$paramName);
            if($status){
                $arr=array();   //array to store result set
                $i=0;
                while($stmt->fetch()){                   
                    $arr_manual["settingsID"]=$settingsID;
                    $arr_manual["paramID"]=$paramID;
                    $arr_manual["warningLevel"]=$warningLevel;
                    $arr_manual["paramName"]=$paramName;
                    $arr["warning2DArray"][$i]=$arr_manual; //fetch each row
                    $arr_auto["alarmID"]=$alarmID;
                    $arr_auto["alarmLevel"]=$alarmLevel;
                    $arr_auto["norminalLevel"]=$norminalLevel;
                    $arr["alarms2DArray"][$i++]=$arr_auto;
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
    
    public function retrieveAllParameters():array {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*********RETRIEVE ALL Parameter Names from Database*************/
            $query="SELECT * FROM WheelParameters ORDER BY ParamID Asc LIMIT 4";
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
