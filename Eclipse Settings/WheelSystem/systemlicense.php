<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UserClasses\BusinessLayer\License;
use UserClasses\BusinessObjects\SystemLicenseBO;
use UserClasses\BusinessLayer\ManageSession;
    //View
    $app->get('/systemlicense', function (Request $request, Response $response, array $args) {
        //Create Objects
        $license=new License();
        $licenseBO=new SystemLicenseBO();
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
        if(isset($_SESSION["staffNumber"])){
            if($license->checkLicenseExists($licenseBO)){
                $licenseBO->setDataExistsStatus(true);
                $lic_arr=$license->listLicenseData($licenseBO);
                $licenseBO->set($lic_arr);
            }
            else {
                $licenseBO->setDataExistsStatus(false);
            }
            $licenseBO->setTransactionStatus(true);
            $arr=$licenseBO->getArray();
            $_SESSION["lastActive"]=time();
        }
        else{
            $licenseBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $licenseBO->set($arr_error);
            $arr=$licenseBO->getArray();
        }        
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($license);
        unset($licenseBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
    });
    
    //Add        
    $app->post('/systemlicense/add', function (Request $request, Response $response, array $args) {
        //Create Objects
        $license=new License();
        $licenseBO=new SystemLicenseBO();
        //Return Associative Array        
        $form_data=json_decode($request->getBody()->getContents(),TRUE);  //get client form data
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
        if(isset($_SESSION["staffNumber"])){
            $licenseBO->set($form_data);
            $licenseBO->setStaffNumber($_SESSION["staffNumber"]);
            $licenseBO->setTransactionStatus($license->addLicense($licenseBO));            
            $arr=$licenseBO->getArray();
            $_SESSION["lastActive"]=time();
        }
        else{
            $licenseBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $licenseBO->set($arr_error);           
            $arr=$licenseBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($license);
        unset($licenseBO);         
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
        
    });
    
    //Update
    $app->post('/systemlicense/update', function (Request $request, Response $response, array $args) {
        //Create Objects
        $license=new License();
        $licenseBO=new SystemLicenseBO();
        //Return Associative Array
        $form_data=json_decode($request->getBody()->getContents(),TRUE);  //get client form data
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
        if(isset($_SESSION["staffNumber"])){
            $licenseBO->set($form_data);
            $licenseBO->setStaffNumber($_SESSION["staffNumber"]);
            $licenseBO->setTransactionStatus($license->updateLicense($licenseBO));
            $arr=$licenseBO->getArray();
            $_SESSION["lastActive"]=time();
        }
        else{
            $licenseBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $licenseBO->set($arr_error);
            $arr=$licenseBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($license);
        unset($licenseBO);        
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
        
    });
    
            
?>