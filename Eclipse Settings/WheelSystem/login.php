<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
    //Check If User Exists in System
    $app->get('/login/checkexistence/{staffnumber_password}', function (Request $request, Response $response, array $args) {
        $arr["name"]="Bhekisizwe";
        $arr["surname"]="Mthethwa";
        $arr_json=json_encode($arr);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    }); 
    
    //View User Account Profile
    $app->get('/login/{staffnumber}', function (Request $request, Response $response, array $args) {
        
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    }); 
        
    //Update
    $app->post('/login/update', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
?>
