<?php
declare(strict_types=1);
namespace UserClasses\DataLayer;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class AdminAccountDL extends UserAccountDL
{
    public function retrieveAllAdmin():array{
        
        $connector=$this->dbConnect();  //connect to MariaDB database
        if(isset($connector)){
            //successfully connected to database
            /***Retrieve All Administrators in Database*******/
            $query="SELECT UserAccounts.AccountID,UserAccounts.Name,UserAccounts.Surname,";
            $query.="UserAccounts.StaffNumber,UserAccounts.Email,UserAccounts.Password,UserAccounts.ActivityState,";
            $query.="UserRole.RoleID,UserRole.UserRoleName FROM UserAccounts,UserRole";
            $query.=" WHERE UserRole.UserRoleName='Admin' AND UserRole.RoleID=UserAccounts.RoleID ORDER BY UserAccounts.Surname Asc";
            $result=$connector->query($query);
            if($result){
                $arr_2D=array();        //array that stores result set
                while($rows=$result->fetch_assoc()){
                    $arr_2D[]=$rows;    
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

