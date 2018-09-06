<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
    //View All User Roles, Activity Names, and Report Column Names
    $app->get('/userrole', function (Request $request, Response $response, array $args) {
        $arr["name"]="Bhekisizwe";
        $arr["surname"]="Mthethwa";
        $arr_json=json_encode($arr);
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //Check if User Role exists
    $app->get('/userrole/checkexistence/{userrolename}', function (Request $request, Response $response, array $args) {
        
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //View Access Rights
    $app->get('/userrole/{roleid}', function (Request $request, Response $response, array $args) {
        
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
    });
    
    //Add
    $app->post('/userrole/add', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
        
    //Update
    $app->post('/userrole/update', function (Request $request, Response $response, array $args) {
        //Return Associative Array
        $arr=json_decode($request->getBody()->getContents(),TRUE);
        
        
        $arr_json=json_encode($arr);    //Return JSON Data Object
        $res=$response->withHeader("Content-Type", "application/json");
        return $res->getBody()->write($arr_json);
        
    });
?>
