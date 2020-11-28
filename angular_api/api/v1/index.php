<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/angular_api/api/v1/includes/header.php');
require_once($_SERVER["DOCUMENT_ROOT"] . ''.url_config.'helper/statusCode.php');
require_once($_SERVER["DOCUMENT_ROOT"] . ''.url_config.'framework/InterceptSwitch.php');
require_once($_SERVER["DOCUMENT_ROOT"] . ''.url_config.'includes/Authorization.php');


session_start();  

class main
{
    function __construct()
    {
        $this->api();
    }

    private function api()
    {
        $headers = getallheaders();
        // get all headers and check the authorization 
        if (isset($headers['commtext']) && $headers['commtext'] == commtext) {
            try {
                $requested_url = $_SERVER['PATH_INFO'];
                $requested_method = $_SERVER['REQUEST_METHOD'];
                // var_dump($requested_method);die;
                $json = file_get_contents('php://input');
                $data = json_decode($json);
                // var_dump($data);die;
                $URL_Method_configs = explode('/', $requested_url);
                $AuthArray = ["headers" => $headers, "requestMethod" => $requested_method];
                // echo json_encode([$AuthArray,$data]);die;
                $this->working($AuthArray, $URL_Method_configs, $data, true);
            } catch (Exception $e) {
                echo json_encode(getResponseStatusMessages(403, "Something went wrong request could not process",$e));
            }
        } else {
            echo json_encode(getResponseStatusMessages(405));
        }
    }

    private function working($AuthArray, $URL_Method_configs, $data, $checkAuth)
    {   
        
        // echo json_encode("abc");die;
        if ($checkAuth) {
            $authObj = new Auth();
            $authResp = $authObj->_isEndPointAccessibleFor($URL_Method_configs, $AuthArray);
            // var_dump($authResp);die;
            // echo json_encode("fghfghfh");die;
            if ($authResp->status) {
                $IObj = new Interceptor();
                $methodName = $authResp->methodAccess;
               
                ini_set('display_errors', 1);
                set_error_handler(function ($errno, $errstr, $errfile, $errline, $errcontext) {
                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
                });
                try {
                    //main execution
                    // echo json_encode($data);die;
                    
                    $this->response = $IObj->$methodName($authResp->apiAccess, $data);
                    //var_dump($this->response);die;
                   
                } catch (ErrorException $e) {
                    $this->response = getResponseStatusMessages(500, 'Failed To process your Request , please try again',$e);
                    // var_dump($e);
                }
            } else {
                // authorization error 
                $this->response = getResponseStatusMessages(405, $authResp->message);
            }
        } else {
            $this->response = getResponseStatusMessages(406);
        }
        echo json_encode($this->response);
    }
}

$obj = new main();
