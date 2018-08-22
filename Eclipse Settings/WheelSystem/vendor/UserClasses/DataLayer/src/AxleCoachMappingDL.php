<?php
declare(strict_types=1);
namespace UserClasses\DataLayer;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class AxleCoachMappingDL extends DatabaseManager implements DatabaseFunctionsInt
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
            /***INSERT Axle-Coach Mapping data into Database*******/
            $query="INSERT INTO AxleCoachMapping";
            $query.=" (MappingID,AxleSerialNumber,AxleNumber,SetNumber,CoachNumber,DateCreated)";
            $query.=" VALUES ('',?,?,?,?,DATE(NOW()))";
            //prepare SQL script for execution
            $stmt=$connector->prepare($query);
            //bind parameters
            $axleSerialNumber=$data["axleSerialNumber"];
            $axleNumber=$data["axleNumber"];
            $setNumber=$data["setNumber"];
            $coachNumber=$data["coachNumber"];
            $stmt->bind_param("siss",$axleSerialNumber,$axleNumber,$setNumber,$coachNumber);
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
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \UserClasses\DataLayer\DatabaseFunctionsInt::searchData()
     */
    public function searchData(array $data):array
    {
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            $arr_2D=array();
            //successfully connected to database
            $query="SELECT * FROM AxleCoachMapping WHERE AxleSerialNumber=? AND ";
            $query.="(DateCreated>=DATE_FORMAT(?,'%Y-%m-%d') AND DateCreated<=DATE_FORMAT(?,'%Y-%m-%d')";
            $stmt=$connector->prepare($query);
            $axleSerialNumber=$data["axleSerialNumber"];
            $startDate=$data["startDate"];
            $endDate=$data["endDate"];
            $stmt->bind_param("sss",$axleSerialNumber,$startDate,$endDate);
            $status=$stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($mappingid,$axleserialnumber,$axlenumber,$setnumber,$coachnumber,$datecreated);
            if($status){
                $arr=array();
                while($stmt->fetch()){
                    $arr["mappingID"]=$mappingid;
                    $arr["axleSerialNumber"]=$axleserialnumber;
                    $arr["axleNumber"]=$axlenumber;
                    $arr["setNumber"]=$setnumber;
                    $arr["coachNumber"]=$coachnumber;
                    $arr["dateCreated"]=$datecreated;                    
                    $arr_2D[]=$arr; //append Associative array to the end of the 2 Dimensional Array
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

