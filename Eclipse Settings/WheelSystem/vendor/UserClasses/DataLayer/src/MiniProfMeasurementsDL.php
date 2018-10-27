<?php
declare(strict_types=1);
namespace UserClasses\DataLayer;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class MiniProfMeasurementsDL extends DatabaseManager implements DatabaseFunctionsInt
{

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::getPrimaryKey()
     */
    public function getPrimaryKey(array $data):int
    {}

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
            /***INSERT MiniProf Measurements Data into Database*******/
            $query="INSERT INTO WheelMeasurements";
            $query.=" (MeasurementID,CoachNumber,SetNumber,AxleNumber,WheelID,OperatorName,";
            $query.="Meas_Date,Meas_Time,Sh,qR,FW,H)";
            $query.=" VALUES ('',?,?,?,?,?,?,?,?,?,?,?)";
            //prepare SQL script for execution
            $stmt=$connector->prepare($query);
            //bind parameters
            $coachNumber=$data["coachNumber"];
            $setNumber=$data["setNumber"];
            $axleNumber=$data["axleNumber"];
            $wheelID=$data["wheelID"];
            $operatorName=$data["operatorName"];
            $meas_date=$data["measurementDate"];
            $meas_time=$data["measurementTime"];
            $Sh=$data["flangeHeight"];
            $qR=$data["toeCreep"];
            $FW=$data["flangeWidth"];
            $H=$data["hollowing"];
            $stmt->bind_param("ssiisssdddd",$coachNumber,$setNumber,$axleNumber,$wheelID,$operatorName,$meas_date,$meas_time,$Sh,$qR,$FW,$H);
            $status_message=$stmt->execute();
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
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::dataExists()
     */
    public function dataExists(array $data):bool
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*****Check if Specific Wheel Data already exists in Database*******/
            $query="SELECT MeasurementID FROM WheelMeasurements WHERE SetNumber=? AND ";
            $query.="Meas_Date=? AND Meas_Time=? AND CoachNumber=? AND WheelID=?";
            $stmt=$connector->prepare($query);
            $setNumber=$data["setNumber"];
            $meas_date=$data["measurementDate"];
            $meas_time=$data["measurementTime"];
            $coachNumber=$data["coachNumber"];
            $wheelID=$data["wheelID"];
            $stmt->bind_param("ssssi",$setNumber,$meas_date,$meas_time,$coachNumber,$wheelID);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($measurementid);
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
            $query="DELETE FROM WheelMeasurements";
            $status_message=$connector->query($query);
            $query="ALTER TABLE WheelMeasurements AUTO_INCREMENT=0";
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
            /*********RETRIEVE Wheel Measurements Data from Database*************/
            $query="SELECT * FROM WheelMeasurements";            
            $query.=" WHERE CoachNumber=? ORDER BY Meas_Date Desc";
            $stmt=$connector->prepare($query);
            $coachNumber=$data["coachNumber"];            
            $stmt->bind_param("s",$coachNumber);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($measurementID,$coachNumber,$setnumber,$axleNumber,$wheelID,$operatorName,$measDate,$measTime,$Sh,$qR,$FW,$H);
            if($status){
                $arr_2D=array();   //array to store result set
                while($stmt->fetch()){
                    $arr["coachNumber"]=$coachNumber;
                    $arr["setNumber"]=$setnumber;
                    $arr["axleNumber"]=$axleNumber;
                    $arr["wheelID"]=$wheelID;
                    $arr["operatorName"]=$operatorName;
                    $arr["measurementDate"]=$measDate;
                    $arr["measurementTime"]=$measTime;
                    $arr["flangeHeight"]=$Sh;
                    $arr["toeCreep"]=$qR;
                    $arr["flangeWidth"]=$FW;
                    $arr["hollowing"]=$H;
                    $arr_2D[]=$arr;
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
    
    public function searchSpecificWheelData(array $data):array {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*********RETRIEVE Specific Wheel Measurements Data from Database*************/
            $query="SELECT * FROM WheelMeasurements";
            $query.=" WHERE CoachNumber=? AND WheelID=? AND Meas_Date=? ORDER BY Meas_Time Desc";
            $stmt=$connector->prepare($query);
            $coachNumber=$data["coachNumber"];
            $wheelID=$data["wheelID"];
            $meas_date=$data["measurementDate"];
            $stmt->bind_param("sis",$coachNumber,$wheelID,$meas_date);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($measurementID,$coachNumber,$setnumber,$axleNumber,$wheelID,$operatorName,$measDate,$measTime,$Sh,$qR,$FW,$H);
            if($status){
                $arr_2D=array();   //array to store result set
                while($stmt->fetch()){
                    $arr["coachNumber"]=$coachNumber;
                    $arr["setNumber"]=$setnumber;
                    $arr["axleNumber"]=$axleNumber;
                    $arr["wheelID"]=$wheelID;
                    $arr["operatorName"]=$operatorName;
                    $arr["measurementDate"]=$measDate;
                    $arr["measurementTime"]=$measTime;
                    $arr["measurementID"]=$measurementID;   
                    $arr_2D[]=$arr;
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

