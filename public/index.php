<?php

    require_once '../vendor/autoload.php';

    use api\controller\{Uri};

    header('Content-Type: application/json');
    //verifica a URL
    if(isset($_SERVER['PATH_INFO'])){
        // faz a separação dos argumentos da URL
        $url = explode('/',$_SERVER['PATH_INFO']);
        // Define os serviços da API
        $parametros = ['user','livro','emprestimo'];

        // Verifica se o argumento passado é um dos serviços validados
        if($url[1] !== 'api' || !in_array(strtolower($url[2]), $parametros)){
            http_response_code(404);
            die();
        }
        // instacia  e inicia a class URI(Responsavel pela leitura das informações da URL)
        $api = new Uri($url);

        $api->run();

        $resut = $api->resultado;
        $status_code = $api->http_status_code;
        // exibi o resultado
        echo $resut;

        if($status_code !== 200){
            
            http_response_code($status_code);

        }
    }
    else{
        http_response_code(404);
    }


    