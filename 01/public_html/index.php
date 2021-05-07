<?php 
    header('Content-Type: application/json');

    require_once '../vendor/autoload.php';

    // api/users/1
    if(isset($_GET['url'])){
        $url = explode("/",$_GET['url']);

        if($url[0] === 'api'){
            array_shift($url); //remove o primeiro item do array [0]
            $service = 'App\Services\\'.ucfirst($url[0].'Service');
            array_shift($url);

            $method = strtolower($_SERVER['REQUEST_METHOD']); //pega o tipo da requisição

            try {
                $response = call_user_func_array(array(new $service, $method), $url);
                http_response_code(200);
                echo json_encode(array('status' => 'success', 'data' => $response), JSON_UNESCAPED_UNICODE);
                exit;
            } catch (\Exception $e) {
                http_response_code(404);
                echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
    }

?>