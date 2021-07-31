<?php
    require_once '../controller/Uri.php';
    require_once '../controller/User.php';

    header('Content-Type: application/json');

    if(isset($_SERVER['PATH_INFO'])){

        $url = explode('/',$_SERVER['PATH_INFO']);

        
        if($url[1] !== 'api' || $url[2] !== 'user'){
            http_response_code(404);
            die();
        }

        $api = new Uri($url);


        $api->run();

        $resut = $api->resultado;
        $status_code = $api->http_status_code;

        echo $resut;

        if($status_code !== 200){
            
            http_response_code($status_code);

        }
    }
    else{
        http_response_code(404);
    }


    