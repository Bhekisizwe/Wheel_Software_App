<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
    //View Specific Wheel reprofiling data
    $app->get('/wheelreprofiling/{axleserialnumber_daterange}', function (Request $request, Response $response, array $args) {
        $arr["name"]="Bhekisizwe";
        $arr["surname"]="Mthethwa Reprofiling";
        $arr_json=json_encode($arr);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //Does specific Wheel Reprofiling Data already exist in System
    $app->get('/wheelreprofiling/checkexistence/{axleserialnumber_serviceprovider_date}', function (Request $request, Response $response, array $args) {
        
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //Add
    $app->post('/wheelreprofiling/add', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
        
    //Update
    $app->post('/wheelreprofiling/update', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
?>