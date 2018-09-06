<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
    //View Specific MiniProf Wheel Data
    $app->get('/manualmeasurements/miniprof/{coachnumber_wheelid_date}', function (Request $request, Response $response, array $args) {
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //View Manual Wheel Data
    $app->get('/manualmeasurements/{measurementid}', function (Request $request, Response $response, array $args) {
        $arr["name"]="Bhekisizwe";
        $arr["surname"]="Mthethwa Manual";
        $arr_json=json_encode($arr);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });            
    
    //Add
    $app->post('/manualmeasurements/add', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
        
    //Update
    $app->post('/manualmeasurements/update', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
?>