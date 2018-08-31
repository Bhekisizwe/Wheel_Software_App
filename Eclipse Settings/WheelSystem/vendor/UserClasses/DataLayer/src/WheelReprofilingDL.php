<?php
declare(strict_types=1);
namespace UserClasses\DataLayer;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class WheelReprofilingDL extends DatabaseManager implements DatabaseFunctionsInt
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
            /***INSERT Wheel Reprofiling Data into Database*******/
            $query="INSERT INTO WheelReprofilingData";
            $query.=" (ReprofilingID,AxleSerialNumber,InitLeftDiameter,FinalLeftDiameter,InitRightDiameter,FinalRightDiameter,Cost,DOW,ServiceProvider) ";
            $query.="VALUES ('',?,?,?,?,?,?,?,?)";
            //prepare SQL script for execution
            $stmt=$connector->prepare($query);
            //bind parameters
            $axleSerialNumber=$data["axleSerialNumber"];
            $initLeftDia=$data["initialLeftDiameter"];
            $finalLeftDia=$data["finalLeftDiameter"];
            $initRightDia=$data["initialRightDiameter"];
            $finalRightDia=$data["finalRightDiameter"];
            $cost=$data["costOfService"];
            $dow=$data["dateOfService"];
            $serviceProvider=$data["serviceProviderName"];          
            $stmt->bind_param("sdddddss",$axleSerialNumber,$initLeftDia,$finalLeftDia,$initRightDia,$finalRightDia,$cost,$dow,$serviceProvider);
            $status_message=$stmt->execute();
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
            /***UPDATE Wheel Reprofiling Data in Database*******/
            $query="UPDATE WheelReprofilingData SET ";
            $query.="AxleSerialNumber=?,InitLeftDiameter=?,FinalLeftDiameter=?,InitRightDiameter=?,";
            $query.="FinalRightDiameter=?,Cost=?,DOW=?,ServiceProvider=? WHERE ReprofilingID=?";
            $stmt=$connector->prepare($query);
            //bind parameters
            $axleSerialNumber=$data["axleSerialNumber"];
            $initLeftDia=$data["initialLeftDiameter"];
            $finalLeftDia=$data["finalLeftDiameter"];
            $initRightDia=$data["initialRightDiameter"];
            $finalRightDia=$data["finalRightDiameter"];
            $cost=$data["costOfService"];
            $dow=$data["dateOfService"];
            $serviceProvider=$data["serviceProviderName"];
            $reprofilingID=$data["reprofilingID"];
            $stmt->bind_param("sdddddsss",$axleSerialNumber,$initLeftDia,$finalLeftDia,$initRightDia,$finalRightDia,$cost,$dow,$serviceProvider,$reprofilingID);
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
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            /*****Check if Wheel Reprpfiling data exists for Axle already exists in Database*******/
            $query="SELECT ReprofilingID FROM WheelReprofilingData WHERE AxleSerialNumber=? AND ";
            $query.="DOW=? AND ServiceProvider=?";
            $stmt=$connector->prepare($query);
            $axleSerialNumber=$data["axleSerialNumber"];
            $dow=$data["dateOfService"];
            $serviceProvider=$data["serviceProviderName"];
            $stmt->bind_param("sss",$axleSerialNumber,$dow,$serviceProvider);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($reprofilingid);
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
            $query="DELETE FROM WheelReprofilingData";
            $status_message=$connector->query($query);
            $query="ALTER TABLE WheelReprofilingData AUTO_INCREMENT=0";
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
            /*********RETRIEVE Wheel Reprofiling Data for a specific axle from Database*************/
            $query="SELECT * FROM WheelReprofilingData ";
            $query.="WHERE (DOW>=? AND DOW<=? ";
            $query.="AND AxleSerialNumber=?)";
            $stmt=$connector->prepare($query);
            $startDate=$data["startDate"];
            $endDate=$data["endDate"];
            $axleSerialNumber=$data["axleSerialNumber"];
            $stmt->bind_param("sss",$startDate,$endDate,$axleSerialNumber);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($reprofilingID,$axleserialnumber,$initleftdia,$finalleftdia,$initrightdia,$finalrightdia,$cost,$dow,$serviceprovider);
            if($status){               
                $arr_2D=array();   //array to store result set
                while($stmt->fetch()){
                    $arr["reprofilingID"]=$reprofilingID;                   
                    $arr["axleSerialNumber"]=$axleserialnumber;
                    $arr["initialLeftDiameter"]=$initleftdia;
                    $arr["finalLeftDiameter"]=$finalleftdia;
                    $arr["initialRightDiameter"]=$initrightdia;
                    $arr["finalRightDiameter"]=$finalrightdia;
                    $arr["costOfService"]=$cost;
                    $arr["dateOfService"]=$dow;
                    $arr["serviceProviderName"]=$serviceprovider;                    
                    $arr_2D[]=$arr;
                }
                $this->dbClose($connector);
                return $arr_2D;
            }
            else {
                $this->dbClose($connector);
                return NULL;
            }
        }
        else return NULL;
    }
}
