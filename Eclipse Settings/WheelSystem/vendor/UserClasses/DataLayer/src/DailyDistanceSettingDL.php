<?php
declare(strict_types=1);
namespace UserClasses\DataLayer;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class DailyDistanceSettingDL extends DatabaseManager implements DatabaseFunctionsInt
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
            /***INSERT DailyDistanceSetting Data into Database*******/
            $query="INSERT INTO DistanceTravelled";
            $query.=" (DistanceID,Distance)";
            $query.=" VALUES ('',?)";
            //prepare SQL script for execution
            $stmt=$connector->prepare($query);
            //bind parameters
            $distance=$data["distance"];            
            $stmt->bind_param("d",$distance);
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
            /***UPDATE Distance Travelled Daily Data in Database*******/
            $query="UPDATE DistanceTravelled SET Distance=? WHERE DistanceID=?";
            $stmt=$connector->prepare($query);
            //bind parameters
            $distance=$data["distance"];
            $distanceID=$data["distanceID"];
            $stmt->bind_param("di",$distance,$distanceID);
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
            $query="DELETE FROM DistanceTravelled";
            $status_message=$connector->query($query);
            $query="ALTER TABLE DistanceTravelled AUTO_INCREMENT=0";
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
            /*********RETRIEVE Average Daily Distance from Database*************/
            $query="SELECT * FROM DistanceTravelled";
            $result=$connector->query($query);
            if($result){
                $arr=array();   //array to store result set
                while($rows=$result->fetch_assoc()){
                    $arr["distanceID"]=$rows["DistanceID"];
                    $arr["distance"]=$rows["Distance"];
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
}

