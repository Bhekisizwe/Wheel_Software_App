<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UserClasses\BusinessLayer\UserRole;
use UserClasses\BusinessObjects\UserRoleBO;
use UserClasses\BusinessLayer\MiniProfDBUploader;
use UserClasses\BusinessObjects\MiniProfMeasurementsBO;
use UserClasses\BusinessLayer\ManageSession;
    //View MiniProf Measurements for a specific Set Number and Date of measurement
    $app->get('/miniprofmeasurements/{setnumber_date}', function (Request $request, Response $response, array $args) {
        //Create Objects
        $miniProf=new MiniProfDBUploader();
        $miniProfBO=new MiniProfMeasurementsBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        $search_str=$args["setnumber_date"];
        $search_arr=explode("_",$search_str);
        $arr=$miniProfBO->getArray();
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
        if(isset($_SESSION["staffNumber"])){
            $userrole_arr["userRole2DArray"][0]["roleID"]=$_SESSION["roleID"];
            $userroleBO->set($userrole_arr);
            $accessRight="R";
            $activityName="Wheel Measurements Management";
            if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                $arr=array();
                $mini["setNumber"]=$search_arr[0];
                $mini["measurementDate"]=$search_arr[1];
                $miniProfBO->set($mini);
                $mini_arr=$miniProf->showWheelData($miniProfBO);
                for($j=0;$j<count($mini_arr);$j++){
                    $miniProfBO->set($mini_arr[$j]);
                    $miniProfBO->setTransactionStatus(true);
                    $arr[]=$miniProfBO->getArray();
                }  
                if(count($mini_arr)==0){
                    $arr[0]["transactionStatus"]=true;
                    $arr[0]["setNumber"]="";
                    $arr[0]["axleNumber"]=0;
                    $arr[0]["coachNumber"]="";
                    $arr[0]["wheelID"]=0;
                    $arr[0]["operatorName"]="";
                    $arr[0]["measurementDate"]="";
                    $arr[0]["measurementTime"]="";
                    $arr[0]["measurementID"]=0;
                    $arr[0]["flangeHeight"]=0;
                    $arr[0]["toeCreep"]=0;
                    $arr[0]["flangeWidth"]=0;
                    $arr[0]["hollowing"]=0;
                } 
            }
            else {
		$arr=array();
                $miniProfBO->setTransactionStatus(false);
                $arr_err=array();
                $arr_err["errorCode"]="0x18";
                $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                $arr_error["errorAssocArray"]=$arr_err;
                $miniProfBO->set($arr_error);
                $arr[]=$miniProfBO->getArray();
            }
            $_SESSION["lastActive"]=time();
        }
        else{
	    $arr=array();
            $miniProfBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $miniProfBO->set($arr_error);
            $arr[]=$miniProfBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($miniProf);
        unset($miniProfBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
    });
    
    //send emails to people to enter the Manual Wheel Measurements    
    $app->post('/miniprofmeasurements/sendemail', function (Request $request, Response $response, array $args) {
        //Create Objects
        $miniProf=new MiniProfDBUploader();
        $miniProfBO=new MiniProfMeasurementsBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        $form_data=json_decode($request->getBody()->getContents(),TRUE);  //get client form data
        $manageSession=new ManageSession();
        if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
        if(isset($_SESSION["staffNumber"])){
            if(count($form_data)>0){
                $miniProfBO->set($form_data);
                $miniProf->getEmailRecepients($miniProfBO);
                $miniProfBO->setTransactionStatus(true);
            }
            else $miniProfBO->setTransactionStatus(false);
            $arr=$miniProfBO->getArray();
            $_SESSION["lastActive"]=time();
        }
        else{
            $miniProfBO->setTransactionStatus(false);
            //write Error Code and Description
            $arr_err=array();
            $arr_err["errorCode"]="0x19";
            $arr_err["errorDescription"]="Session has expired";
            $arr_error["errorAssocArray"]=$arr_err;
            $miniProfBO->set($arr_error);
            $arr=$miniProfBO->getArray();
        }
        $arr_json=json_encode($arr);
        //destroy objects
        unset($manageSession);
        unset($miniProf);
        unset($miniProfBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
    });
    
    //Import
    $app->post('/miniprofmeasurements/import/', function (Request $request, Response $response, array $args) {
        //Create Objects
        $miniProf=new MiniProfDBUploader();
        $miniProfBO=new MiniProfMeasurementsBO();
        $userrole=new UserRole();
        $userroleBO=new UserRoleBO();
        $arr_files=$request->getUploadedFiles();
        $form_data=$request->getParsedBody();
        //$form_data=json_decode($request->getBody()->getContents(),TRUE);  //get client form data
        if(count($arr_files)>0){
            $manageSession=new ManageSession();
            if(isset($_SESSION["lastActive"])) $manageSession->determineSessionValidity(time());
            if(isset($_SESSION["staffNumber"])){
                $userrole_arr["userRole2DArray"][0]["roleID"]=$_SESSION["roleID"];
                $userroleBO->set($userrole_arr);
                $accessRight="C";
                $activityName="Wheel Measurements Management";
                if($userrole->checkUserAuthorization($userroleBO, $accessRight, $activityName)){
                    $miniProfBO->setStaffNumber($_SESSION["staffNumber"]);
                    $miniProfBO->set($form_data);
                    foreach($arr_files["miniprof"] as $upLoadedFiles){
                        $uploaded_file=$upLoadedFiles->getClientFilename();
                        //check if directory exists first
                        $dirPath=$miniProf->getDirPath()."\\".$miniProfBO->getMeasurementDate()."\\".$miniProfBO->getSetNumber();
                        $filename=$miniProfBO->getMeasurementDate()."\\".$miniProfBO->getSetNumber()."\\".$uploaded_file;
                        if(file_exists($dirPath)){
                            //move uploaded files here
                            //check if the file exists already                            
                            if($miniProf->checkFileExists($filename)){
                                //a duplicate file exists, delete it
                                if($miniProf->deleteFile($filename)){
                                    //move files here, its safe to do so.
                                    $upLoadedFiles->moveTo($dirPath."\\".$uploaded_file);
                                    if($miniProf->confirmFileType($filename)){                                        
                                        $miniProfBO->setTransactionStatus($miniProf->readMiniProfTextFileData($miniProfBO));                                        
                                        $arr=$miniProfBO->getArray();
                                    }
                                    else {
                                        $miniProf->deleteFile($filename);
                                        $miniProfBO->setTransactionStatus(false);
                                        //write Error Code and Description
                                        $arr_err=array();
                                        $arr_err["errorCode"]="0x04";
                                        $arr_err["errorDescription"]="Failed to Upload file. The file imported is not a MiniProf Textfile";
                                        $arr_error["errorAssocArray"]=$arr_err;
                                        $miniProfBO->set($arr_error);
                                        $arr=$miniProfBO->getArray();
                                    }
                                }
                            }
                            else{
                                //move files here.its safe to do so
                                $upLoadedFiles->moveTo($dirPath."\\".$uploaded_file);
                                if($miniProf->confirmFileType($filename)){
                                    $miniProfBO->setTransactionStatus($miniProf->readMiniProfTextFileData($miniProfBO));
                                    $arr=$miniProfBO->getArray();
                                }
                                else {
                                    $miniProf->deleteFile($filename);
                                    $miniProfBO->setTransactionStatus(false);
                                    //write Error Code and Description
                                    $arr_err=array();
                                    $arr_err["errorCode"]="0x04";
                                    $arr_err["errorDescription"]="Failed to Upload file. The file imported is not a MiniProf Textfile";
                                    $arr_error["errorAssocArray"]=$arr_err;
                                    $miniProfBO->set($arr_error);
                                    $arr=$miniProfBO->getArray();
                                }
                            }
                        }
                        else{
                            //create the directory
                            if(mkdir($dirPath,0777,true)){
                                //move files here.its safe to do so
                                $upLoadedFiles->moveTo($dirPath."\\".$uploaded_file);
                                if($miniProf->confirmFileType($filename)){
                                    $miniProfBO->setTransactionStatus($miniProf->readMiniProfTextFileData($miniProfBO));
                                    $arr=$miniProfBO->getArray();
                                }
                                else {
                                    $miniProf->deleteFile($filename);
                                    $miniProfBO->setTransactionStatus(false);
                                    //write Error Code and Description
                                    $arr_err=array();
                                    $arr_err["errorCode"]="0x04";
                                    $arr_err["errorDescription"]="Failed to Upload file. The file imported is not a MiniProf Textfile";
                                    $arr_error["errorAssocArray"]=$arr_err;
                                    $miniProfBO->set($arr_error);
                                    $arr=$miniProfBO->getArray();
                                }
                            }
                        }
                    }                       
                }
                else{
                    $miniProfBO->setTransactionStatus(false);
                    $arr_err=array();
                    $arr_err["errorCode"]="0x18";
                    $arr_err["errorDescription"]="You have no access rights to carry out the action you attempted. Please contact the administrator to resolve this.";
                    $arr_error["errorAssocArray"]=$arr_err;
                    $miniProfBO->set($arr_error);
                    $arr=$miniProfBO->getArray();
                }
                $_SESSION["lastActive"]=time();
            }
            else{
                $miniProfBO->setTransactionStatus(false);
                //write Error Code and Description
                $arr_err=array();
                $arr_err["errorCode"]="0x19";
                $arr_err["errorDescription"]="Session has expired";
                $arr_error["errorAssocArray"]=$arr_err;
                $miniProfBO->set($arr_error);
                $arr=$miniProfBO->getArray();
            }            
        }
        else{
            $arr=$miniProfBO->getArray();
        }        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        unset($manageSession);
        unset($miniProf);
        unset($miniProfBO);
        unset($userrole);
        unset($userroleBO);
        $body=$response->getBody();
        $body->write($arr_json);
        return $response->withHeader("Content-Type", "application/json;charset=UTF-8")
        ->withBody($body); 
        
    });       
      
?>
