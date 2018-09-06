<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
    //View User Account
    $app->get('/useraccount/{staffnumber}', function (Request $request, Response $response, array $args) {
        $arr["name"]="Bhekisizwe";
        $arr["surname"]="Mthethwa";
        $arr["staffnumber"]=$args['staffnumber'];
        $arr_json=json_encode($arr);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //Check User Account Exists
    $app->get('/useraccount/checkexistence/{staffnumber}', function (Request $request, Response $response, array $args) {
        
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
        
    //Add
    $app->post('/useraccount/add', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
        
    //Update
    $app->post('/useraccount/update', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
?>
