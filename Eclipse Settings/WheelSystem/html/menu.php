<?php
session_start();
if(isset($_SESSION["userRoleName"])){
    echo "session active!!! ".$_SESSION["userRoleName"];    
}
else{
    echo "session has expired!!!";
}

?>