<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
    //View
    $app->get('/manualwheelsettings', function (Request $request, Response $response, array $args) {
        $arr["name"]="Bhekisizwe";
        $arr["surname"]="Mthethwa Mtati";
        $arr_json=json_encode($arr);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //Add
    $app->post('/manualwheelsettings/add', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
        
    //Update
    $app->post('/manualwheelsettings/update', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
?>
