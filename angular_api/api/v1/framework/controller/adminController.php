<?php
// var_dump();die;


require_once($_SERVER["DOCUMENT_ROOT"] . '' . url_config . 'framework/model/Admin/AdminModel.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '' . url_config . 'helper/statusCode.php');

class AdminController
{

    public function login($data)
    {
        // var_dump($data);die;    
        $db = new AdminModelApplication("common");
        $DBresponse = $db->getUserData($data);
        // echo json_encode($DBresponse);die;
        if ($DBresponse->status) {
            $this->response = getResponseStatusMessages(200, "User logged in success", $DBresponse->user_data);
            return $this->response;
        } else {
            $this->response = getResponseStatusMessages(404, "Invalid Username or Password");
        }
        return $this->response;
    }
    public function UserRegistration($data)
    {
        $db = new AdminModelApplication("common");
        $DBresponse = $db->UserRegistrationApp($data);
        if ($DBresponse->status) {
            $this->response = getResponseStatusMessages(200, "User Data added Sucessfully..!");
            return $this->response;
        } else {
            $this->response = getResponseStatusMessages(304, $DBresponse->message);
        }
        return $this->response;
    }
    public function CreateBlogsApp($data)
    {
        $db = new AdminModelApplication();
        $DBresponse = $db->CreateBlogsAppData($data);
        if ($DBresponse->status) {
            $this->response = getResponseStatusMessages(200, "Blogs Data added Sucessfully..!");
            return $this->response;
        } else {
            $this->response = getResponseStatusMessages(304, $DBresponse->message);
        }
        return $this->response;
   
    }
    public function EditBlogsApp($data)
    {
        $db = new AdminModelApplication();
        $DBresponse = $db->EditBlogsAppData($data);
        if ($DBresponse->status) {
            $this->response = getResponseStatusMessages(200, "Blogs Data added Sucessfully..!",$DBresponse->respData);
            return $this->response;
        } else {
            $this->response = getResponseStatusMessages(304, $DBresponse->message);
        }
        return $this->response;

    }
    public function FetchFilterData($data)
    {
        $db = new AdminModelApplication();
        $DBresponse = $db->FetchFilterDataApp($data);
        if ($DBresponse->status) {
            $this->response = getResponseStatusMessages(200, "Blogs Data Fetch Sucessfully..!",$DBresponse->respData);
            return $this->response;
        } else {
            $this->response = getResponseStatusMessages(304, $DBresponse->message);
        }
        return $this->response;

    }
    public function UpdateBlogsApp($data)
    {
        $db = new AdminModelApplication();
        $DBresponse = $db->UpdateBlogsAppData($data);
        if ($DBresponse->status) {
            $this->response = getResponseStatusMessages(200, "Blogs Data Update Sucessfully..!");
            return $this->response;
        } else {
            $this->response = getResponseStatusMessages(304, "Error while Updating Blog , try again,");
        }
        return $this->response;


    }
    public function DeleteBlogsApp($data)
    {
        $db = new AdminModelApplication();
        $DBresponse = $db->ViewBlogsAppData($data);
        if ($DBresponse->status) {
            $this->response = getResponseStatusMessages(200, "Blogs data deleted  Sucessfully...",);
            // var_dump($this->response);die;
            return $this->response;
        } else {
            $this->response = getResponseStatusMessages(404, "Error while deleting Blogs , try again");
        }
        return $this->response;
          
    }
    public function ViewBlogsApp()
    {
        $db = new AdminModelApplication();
        $DBresponse = $db->ViewBlogsAppData();
        if ($DBresponse->status) {
            $this->response = getResponseStatusMessages(200, "Blogs data got  Sucessfully...", $DBresponse->respData);
            // var_dump($this->response);die;
            return $this->response;
        } else {
            $this->response = getResponseStatusMessages(404, "Error while Updating Blogs , try again");
        }
        return $this->response;
   

    }
    
   
    public function  getUserById()
    {
        // echo json_encode($_SESSION["USER_ID"]);die;
        $db = new AdminModelApplication();
        $DBresponse = $db->getUserById();
        // var_dump($DBresponse->respData);die;
        // echo json_encode($_SESSION["USER_ID"]);die;
        if ($DBresponse->status) {
            $this->response = getResponseStatusMessages(200, "Profile data got  Sucessfully...", $DBresponse->respData);
            // var_dump($this->response);die;
            return $this->response;
        } else {
            $this->response = getResponseStatusMessages(404, "Error while Updating Profile , try again");
        }
        return $this->response;
    }
    

    
   
    

  
       
}
