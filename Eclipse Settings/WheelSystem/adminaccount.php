<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UserClasses\BusinessLayer\AdminAccounts;
use UserClasses\BusinessObjects\UserAccountBO;
    //View All
    $app->get('/adminaccount', function (Request $request, Response $response, array $args) {
        //Create Objects
        $admin=new AdminAccounts();
        $adminBO=new UserAccountBO();
        $arr=array();        
        if(isset($_SESSION["staffNumber"])){           
            $admin_arr=$admin->listAllAdminAccounts();
            for($i=0;$i<count($admin_arr);$i++){
                $adminBO->set($admin_arr[$i]);
                $adminBO->setTransactionStatus(true);
                $arr[$i]=$adminBO->getArray();
            }            
        }
        else{
            $adminBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $adminBO->set($arr_error);
            $arr=$adminBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($admin);
        unset($adminBO);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //Check Staff Number exists
    $app->get('/adminaccount/{staffnumber}', function (Request $request, Response $response, array $args) {
        //Create Objects
        $admin=new AdminAccounts();
        $adminBO=new UserAccountBO();
        $staffNumber=$args["staffnumber"];
        $arr=array();
        if(isset($_SESSION["staffNumber"])){
            $adminBO->setStaffNumber($staffNumber);           
            $adminBO->setDataExistsStatus($admin->checkUserAccountExists($adminBO));
            $adminBO->setTransactionStatus(true);
            $arr=$adminBO->getArray();            
        }
        else{
            $adminBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $adminBO->set($arr_error);
            $arr=$adminBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($admin);
        unset($adminBO);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
        
    //Add
    $app->post('/adminaccount/add', function (Request $request, Response $response, array $args) {
        //Create Objects
        $admin=new AdminAccounts();
        $adminBO=new UserAccountBO();
        //Return Associative Array
        $form_data=json_decode($request->getBody()->getContents(),TRUE);  //get client form data        
        if(isset($_SESSION["staffNumber"])){
            $adminBO->set($form_data);
            $adminBO->setAdminStaffNumber($_SESSION["staffNumber"]);
            $adminBO->setRoleID(2);
            $adminBO->setTransactionStatus($admin->addUserAccount($adminBO));
            if(!$adminBO->getTransactionStatus()){  
                $arr_error["errorAssocArray"][10]=$admin->getUserAccountBO()->getErrorAssocArray();
                $adminBO->set($arr_error);
            }
            $arr=$adminBO->getArray();
        }
        else{
            $adminBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $adminBO->set($arr_error);
            $arr=$adminBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($admin);
        unset($adminBO); 
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
        
    //Update
    $app->post('/adminaccount/update', function (Request $request, Response $response, array $args) {
        //Create Objects
        $admin=new AdminAccounts();
        $adminBO=new UserAccountBO();
        //Return Associative Array
        $form_data=json_decode($request->getBody()->getContents(),TRUE);  //get client form data
        if(isset($_SESSION["staffNumber"])){
            $adminBO->set($form_data);
            $adminBO->setActionCode("0xA100");
            $adminBO->setAdminStaffNumber($_SESSION["staffNumber"]);
            $adminBO->setTransactionStatus($admin->updateUserAccount($adminBO));
            $arr=$adminBO->getArray();
        }
        else{
            $adminBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $adminBO->set($arr_error);
            $arr=$adminBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($admin);
        unset($adminBO); 
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
