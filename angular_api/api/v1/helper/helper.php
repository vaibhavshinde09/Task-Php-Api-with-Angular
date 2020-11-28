<?php



require_once($_SERVER["DOCUMENT_ROOT"] . ''.url_config.'includes/header.php');
require_once($_SERVER["DOCUMENT_ROOT"] . ''.url_config.'framework/model/Admin/AdminModel.php');

class helper 
{  
 
    function __construct()
    {
        // if(session_id()){session_start();}
    }

    public function setUser($user_data, $user_id)
    {   global $auth_obj;
        // var_dump($user_id);die;
        return $this->generateToken($user_id);
    }

    public function getUser()
    {
        $response = $_SESSION["user"];
       // $response = $_SESSION["category_id"];
        return $response;
    }

    public function destroyUser()
    {
        unset($_SESSION["user_data"]);
    }

    public function generateToken($user_id)
    {
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $obj = (object) ['user_id' => $user_id, 'date' => $date, 'time' => $time];
        $json_obj = json_encode($obj);
        $encryptObj = $this->encrypt($json_obj);
        return $encryptObj;
    }

    public function validateToken($apiToken)
    {   
        //echo json_encode($apiToken);die;

        $resp = $this->decrypt($apiToken);
        
        $applObj = new  AdminModelApplication("common");
        if ( ( (object)($applObj->getUserById($resp->user_id))->status)) {
            $_SESSION["USER_ID"] = $resp->user_id;
            // echo json_encode($_SESSION["USER_ID"]);die;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function encrypt($param)
    {
        $str = base64_encode($param);
        return $str;
    }

    private function decrypt($param)
    {
        $str = base64_decode($param);
        return  json_decode($str);
    }

    public function generateRandomOtp()
    {
        $iDigits = "135792468";
        $iOtp = "";
        for ($i = 1; $i <= 4; $i++) {
            $iOtp .= substr($iDigits, (rand() % (strlen($iDigits))), 1);
        }
        return $iOtp;
    }
}
