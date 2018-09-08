<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UserClasses\BusinessLayer\TermsAndConditions;
use UserClasses\BusinessObjects\TermsConditionsBO;
    //View
    $app->get('/termsconditions', function (Request $request, Response $response, array $args) {
        //Create Objects
        $terms=new TermsAndConditions();
        $termsBO=new TermsConditionsBO();
        if(isset($_SESSION["staffNumber"])){
            if($terms->checkTermsExist($termsBO)){
                $termsBO->setDataExistsStatus(true);
                $terms_arr=$terms->listTermsData($termsBO);
                $termsBO->set($terms_arr);
            }
            else {
                $termsBO->setDataExistsStatus(false);
            }
            $termsBO->setTransactionStatus(true);
            $arr=$termsBO->getArray();
        }
        else{
            $termsBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $termsBO->set($arr_error);
            $arr=$termsBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($terms);
        unset($termsBO);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //Add
    $app->post('/termsconditions/add', function (Request $request, Response $response, array $args) {
        //Create Objects
        $terms=new TermsAndConditions();
        $termsBO=new TermsConditionsBO();
        //Return Associative Array
        $form_data=json_decode($request->getBody()->getContents(),TRUE);  //get client form data
        if(isset($_SESSION["staffNumber"])){
            $termsBO->set($form_data);
            $termsBO->setStaffNumber($_SESSION["staffNumber"]);
            $termsBO->setTransactionStatus($terms->addTerms($termsBO));
            $arr=$termsBO->getArray();
        }
        else{
            $termsBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $termsBO->set($arr_error);
            $arr=$termsBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($terms);
        unset($termsBO); 
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
        
    //Update
    $app->post('/termsconditions/update', function (Request $request, Response $response, array $args) {
        //Create Objects
        $terms=new TermsAndConditions();
        $termsBO=new TermsConditionsBO();
        //Return Associative Array
        $form_data=json_decode($request->getBody()->getContents(),TRUE);  //get client form data
        if(isset($_SESSION["staffNumber"])){
            $termsBO->set($form_data);
            $termsBO->setStaffNumber($_SESSION["staffNumber"]);
            $termsBO->setTransactionStatus($terms->updateTerms($termsBO));
            $arr=$termsBO->getArray();
        }
        else{
            $termsBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"][19]=$arr_err;
            $termsBO->set($arr_error);
            $arr=$termsBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($terms);
        unset($termsBO); 
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
?>
