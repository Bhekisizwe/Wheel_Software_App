<?php
declare(strict_types=1);
namespace UserClasses\BusinessLayer;

use UserClasses\BusinessObjects\UserAccountBO;

/**
 *
 * @author Bheki Mthethwa
 *        
 */
class LoginCredentials extends UserAccounts
{
    private $sender;
    private $err;

    /**
     */
    public function __construct()
    {
        parent::__construct();
        $this->sender=new Email();
        $this->err=new ErrorLog();
    }

    /**
     */
    function __destruct()
    {
        $this->sender=null;
        $this->err=null;
        parent::__destruct();
    }
    
    public function findUserAccountMatch(UserAccountBO $data):bool {
        
    }
    
    public function updateUserPassword(UserAccountBO $data):bool {
        
    }
    
    public function resetUserPassword(UserAccountBO $data):bool {
        
    }
}

