<?php
require_once($_SERVER["DOCUMENT_ROOT"] . ''.url_config.'helper/statusCode.php');
require_once($_SERVER["DOCUMENT_ROOT"] . ''.url_config.'includes/header.php');
require_once($_SERVER["DOCUMENT_ROOT"] . ''.url_config.'helper/helper.php');

class Auth
{
    function __construct()
    {
    }

    
    public function _isEndPointAccessibleFor($Methods, $AuthArray)
    {
        // echo json_encode("tyuytutu");die;
        $endPoint = $Methods[count($Methods) - 1];
        $methodType = $AuthArray["requestMethod"];
        $headers = $AuthArray["headers"];
        
        $arrPublicAPis = [
            'POST' => ['login','user_registr']
        ];
        $arrAdminAPis = [
            'GET' => ['viewblogs'],
            'POST' => ['createblogs','edit_blog_data','fetch_fliter_data'],
            'DELETE' => ['Deleteblogs'],
            'PUT' => ['updateblogs']
        ];
        $arrClientAPis = [
            'GET' => [],
            'POST' => [],
            'DELETE' => [],
            'PUT' => []
        ];
         $arrUser = [
            'GET' => [],
            'POST' => [],
            'DELETE' => [],
            'PUT' => []
        ];
       
    // echo json_encode(array_key_exists($methodType, $arrPublicAPis) && in_array($endPoint, $arrPublicAPis[$methodType]));die;

        if (array_key_exists($methodType, $arrAdminAPis) && in_array($endPoint, $arrAdminAPis[$methodType])) {
            //var_dump(in_array($endPoint, $arrAdminAPis[$methodType]));die;
            return (object) ["status" => $this->headerAuth($headers) ? TRUE:FALSE ,"message" => "Invalid Authorization Key" ,"apiAccess" => $endPoint, "methodAccess" => "admin"];
        } 
        // else if (array_key_exists($methodType, $arrTelecallermanagerAPis) && in_array($endPoint, $arrTelecallermanagerAPis[$methodType])) {
        //     return (object) ["status" => $this->headerAuth($headers) ? TRUE:FALSE ,"message" => "Invalid Authorization Key" , "apiAccess" => $endPoint, "methodAccess" => "telecaller"];  
        // }
        else if (array_key_exists($methodType, $arrUser) && in_array($endPoint, $arrUser[$methodType])) {
//        var_dump(in_array($endPoint, $arrUser[$methodType]));die;

            return (object) ["status" => $this->headerAuth($headers) ? TRUE:FALSE ,"message" => "Invalid Authorization Key" , "apiAccess" => $endPoint, "methodAccess" => "user"];
        } 
        else if(array_key_exists($methodType, $arrPublicAPis) && in_array($endPoint, $arrPublicAPis[$methodType])) {
            return (object) ["status" => TRUE, "apiAccess" => $endPoint, "methodAccess" => "common"];
        }
  //      else if(array_key_exists($methodType, $arrClientAPis) && in_array($endPoint, $arrClientAPis[$methodType])) {
            //     var_dump(in_array($endPoint, $arrUser[$methodType]));die;

//            return (object) ["status" => TRUE, "apiAccess" => $endPoint, "methodAccess" => "client"];
    //    }
       
         else{
            return (object) ["status" => FALSE, "message" => "Invalid request uri type"];
        }
    }

    private function headerAuth($headers)
    {
        // var_dump("hello");die;
         $helperObj = new helper();
         if(isset($headers["AuthKey"]))
            return $helperObj->validateToken($headers["AuthKey"]) ? TRUE : FALSE;
      else{
           return false;
        }
    }
}
