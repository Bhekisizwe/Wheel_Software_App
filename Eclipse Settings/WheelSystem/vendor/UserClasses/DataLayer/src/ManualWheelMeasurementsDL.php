<?php
declare(strict_types=1);
namespace UserClasses\DataLayer;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class ManualWheelMeasurementsDL extends DatabaseManager implements DatabaseFunctionsInt
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
            /***INSERT Manual Wheel Measurements Data into Database*******/
            $query="INSERT INTO ManualMeasurements";
            $query.=" (ManualID,MeasurementID,SR,CTW,CTD,CTDFF,WS,GibsonDescription,WheelSize,Unit)";            
            $query.=" VALUES ('',?,?,?,?,?,?,?,?,?)";
            //prepare SQL script for execution
            $stmt=$connector->prepare($query);
            //bind parameters
            $measurementID=$data["measurementID"];
            $SR=$data["spreadRim"];
            $CTW=$data["cutTyreWidth"];
            $CTD=$data["cutTyreDepth"];
            $CTDFF=$data["cutTyreDistanceFromFlange"];
            $WS=$data["wheelSkid"];
            $gibsonDescr=$data["gibsonDescription"];
            $wheelSize=$data["wheelSize"];
            $unit=$data["unit"];
            $stmt->bind_param("sdddddsds",$measurementID,$SR,$CTW,$CTD,$CTDFF,$WS,$gibsonDescr,$wheelSize,$unit);
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
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /***UPDATE Manual Wheel Measurements Data in Database*******/
            $query="UPDATE ManualMeasurements SET ";
            $query.="SR=?,CTW=?,CTD=?,CTDFF=?,WS=?,GibsonDescription=?,WheelSize=?,Unit=?";
            $query.=" WHERE MeasurementID=?";
            $stmt=$connector->prepare($query);
            //bind parameters
            $SR=$data["spreadRim"];
            $CTW=$data["cutTyreWidth"];
            $CTD=$data["cutTyreDepth"];
            $CTDFF=$data["cutTyreDistanceFromFlange"];
            $WS=$data["wheelSkid"];
            $measurementID=$data["measurementID"];
            $gibsonDescr=$data["gibsonDescription"];
            $wheelSize=$data["wheelSize"];
            $unit=$data["unit"];
            $stmt->bind_param("dddddsdss",$SR,$CTW,$CTD,$CTDFF,$WS,$gibsonDescr,$wheelSize,$unit,$measurementID);
            $status_message=$stmt->execute();
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
            $query="DELETE FROM ManualMeasurements";
            $status_message=$connector->query($query);
            $query="ALTER TABLE ManualMeasurements AUTO_INCREMENT=0";
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
            /*********RETRIEVE Manual Wheel Measurements Data from Database*************/
            $query="SELECT * FROM ManualMeasurements WHERE MeasurementID=?";           
            $stmt=$connector->prepare($query);
            $measurementID=$data["measurementID"];            
            $stmt->bind_param("s",$measurementID);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($manualid,$measurementid,$SR,$CTW,$CTD,$CTDFF,$WS,$gibsonDescr,$wheelsize,$unit);
            if($status){
                $arr_2D=array();   //array to store result set
                while($stmt->fetch()){
                    $arr["measurementID"]=$measurementid;
                    $arr["spreadRim"]=$SR;
                    $arr["cutTyreWidth"]=$CTW;
                    $arr["cutTyreDepth"]=$CTD;
                    $arr["cutTyreDistanceFromFlange"]=$CTDFF;
                    $arr["wheelSkid"]=$WS;  
                    $arr["gibsonDescription"]=$gibsonDescr;
                    $arr["wheelSize"]=$wheelsize;
                    $arr["unit"]=$unit;
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
    
    public function readWheelDataForReport(array $data):array {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*********RETRIEVE MiniProf and/or Manual Wheel Measurements Data from Database*************/
            $query="SELECT * FROM WheelMeasurements,ManualMeasurements ";
            $query.="WHERE (Meas_Date=? ";
            $query.="AND WheelMeasurements.MeasurementID=ManualMeasurements.MeasurementID)"; 
            $stmt=$connector->prepare($query);
            $reportStart=$data["reportStartDate"];
            //$reportEnd=$data["reportEndDate"];
            $stmt->bind_param("s",$reportStart);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($measurementID,$coachNumber,$setNumber,$axleNumber,$wheelID,$operatorName,$measDate,$measTime,$Sh,$qR,$FW,$H,$manualID,$measurementid,$SR,$CTW,$CTD,$CTDFF,$WS,$gibsonDescr,$wheelsize,$unit);
            if($status){
                $store_keys=array();
                $arr_2D=array();   //array to store result set
                while($stmt->fetch()){                    
                    $arr["measurementID"]=$measurementID;  
                    $store_keys[]=$measurementID;
                    $arr["spreadRim"]=$SR;
                    $arr["cutTyreWidth"]=$CTW;
                    $arr["cutTyreDepth"]=$CTD;
                    $arr["cutTyreDistanceFromFlange"]=$CTDFF;
                    $arr["wheelSkid"]=$WS;                   
                    $arr["hollowing"]=$H;
                    $arr["flangeWidth"]=$FW;
                    $arr["toeCreep"]=$qR;
                    $arr["flangeHeight"]=$Sh;
                    $arr["measurementTime"]=$measTime;
                    $arr["measurementDate"]=$measDate;
                    $arr["operatorName"]=$operatorName;
                    $arr["coachNumber"]=$coachNumber;
                    $arr["setNumber"]=$setNumber;
                    $arr["axleNumber"]=$axleNumber;
                    $arr["wheelID"]=$wheelID;                  
                    $arr["gibsonDescription"]=$gibsonDescr;
                    $arr["wheelSize"]=$wheelsize;
                    $arr["unit"]=$unit;
                    $arr_2D[]=$arr;                  
                }
                //search for the other rows in WheelMeasurements with different MeasurementIDs
                if(count($store_keys)>0){
                    $string_of_ids=implode(",",$store_keys);
                    $IN_STRING="(".$string_of_ids.")";
                } 
                else {
                    $IN_STRING="(0)";
                }
                $query="SELECT * FROM WheelMeasurements ";
                $query.="WHERE (Meas_Date=?) ";
                $query.="AND MeasurementID NOT IN ".$IN_STRING;
                $stmt=$connector->prepare($query);
                $reportStart=$data["reportStartDate"];
                //$reportEnd=$data["reportEndDate"];
                $stmt->bind_param("s",$reportStart);
                $status=$stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($measurementID,$coachNumber,$setNumber,$axleNumber,$wheelID,$operatorName,$measDate,$measTime,$Sh,$qR,$FW,$H);
                if($status){                    
                    while($stmt->fetch()){
                        $arr["measurementID"]=$measurementID;  
                        $arr["spreadRim"]=0;
                        $arr["cutTyreWidth"]=0;
                        $arr["cutTyreDepth"]=0;
                        $arr["cutTyreDistanceFromFlange"]=0;
                        $arr["wheelSkid"]=0;
                        $arr["gibsonDescription"]="";
                        $arr["wheelSize"]=0;
                        $arr["unit"]="mm";
                        $arr["hollowing"]=$H;
                        $arr["flangeWidth"]=$FW;
                        $arr["toeCreep"]=$qR;
                        $arr["flangeHeight"]=$Sh;
                        $arr["measurementTime"]=$measTime;
                        $arr["measurementDate"]=$measDate;
                        $arr["operatorName"]=$operatorName;
                        $arr["coachNumber"]=$coachNumber;
                        $arr["setNumber"]=$setNumber;
                        $arr["axleNumber"]=$axleNumber;
                        $arr["wheelID"]=$wheelID; 
                        $arr_2D[]=$arr;
                    }
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

