
<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '' . url_config . 'includes/header.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '' . url_config . 'includes/db/db_connect.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '' . url_config . 'helper/helper.php');

class AdminModelApplication
{

    private $con;
    private  $res;
    private $db;
    private $user_id;
    function __construct($methodAccess = NULL)
    {
        $this->db = new DB_CONNECT();
        $this->con = $this->db->connect();
        $this->res = (object) [];

        if ($methodAccess != "common") {

            $this->user_id = $_SESSION["USER_ID"];
        }
        // 
    }


    public function getUserById($id = null)
    {
        // echo json_encode($_SESSION["USER_ID"]);die;

        // echo json_encode($this->user_id);die;

        $sql = "select * from tbl_user where  ";
        if ($id !== null) {
            $sql .= "user_id='$id'";
        } else {

            $sql .= "user_id=$this->user_id";
            // echo json_encode($sql);
        }

        $result = $this->con->prepare($sql);
        if ($result->execute()) {
            // $number_of_rows = $result->rowCount();
            // var_dump($number_of_rows);die;
            if ($result->rowCount() > 0) {

                $obj = (object) [];
                $row = $result->fetch();
                $obj->user_id = $row['user_id'];
                $obj->username = $row['username'];
               
                $this->res->status = true;
                $this->res->respData = $obj;
            } else {
                $this->res->status = false;
            }
        } else { //invalid username or password
            $this->res->status = false;
        }
        $res = $this->res;
        $this->res = (object) [];
        return $res;
    }
     public function UserRegistrationApp($data)
    {
        //$user_id = $data->user_id;
        $username = $data->username;
        $user_email = $data->user_email;
        $password = $data->password;

        $sql="INSERT INTO `tbl_user`(`username`,`user_email`,`password`)VALUES('$username','$user_email','$password')";
        $result = $this->con->prepare($sql);
        if ($result->execute()) {
          //  if ($result->rowCount() > 0) {
                $this->res->status = true;
            } else {
                $this->res->status = false;
               // $this->res->message = "No change in data";
            }
        
        return $this->res;
    }
    public function CreateBlogsAppData($data)
    {
        $title = $data->title;
        $sub_title = $data->sub_title;
        $tags = $data->tags;
        $content = $data->content;

        $sql="INSERT INTO `tbl_blog`(`title`,`sub_title`,`tags`,`content`)VALUES('$title','$sub_title','$tags','$content')";
        $result = $this->con->prepare($sql);
        if ($result->execute()) {
                $this->res->status = true;
            } else {
                $this->res->status = false;
            }
        
        return $this->res;
    }

    public function UpdateBlogsAppData($data)
    {
        $id = $data->id;
        $title = $data->title;
        $sub_title = $data->sub_title;
        $tags = $data->tags;
        $content = $data->content;


      //  $sql1 = "update `tbl_blog` set title='$title',sub_title='$sub_title',tags='$tags',content='$content' where id='$id'";
        $sql1="UPDATE `tbl_blog` SET `title`='$title',`sub_title`='$sub_title',`tags`='$tags',`content`='$content' WHERE `id`='$id'";
        $result = $this->con->prepare($sql1);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                $this->res->status = true;
            } else {
                $this->res->status = false;
                $this->res->message = "No change in data";
            }
        } else {
            $this->res->status = false;
            $this->res->message = "Error While Updating data , please try again";
        }
        return $this->res;
    }
    public function ViewBlogsAppData()  
    {
        $sql = "SELECT * FROM `tbl_blog`";
        $result = $this->con->prepare($sql);
        if ($result->execute()) {
            $respData = $result->fetchAll();
            $data = (object) [];
            $array = array();

            foreach ($respData as $row) {
                
                $data = (object) [];
                $data->id = $row["id"];
                $data->title = $row["title"];
                $data->sub_title = $row["sub_title"];
                $data->content = $row["content"];
                $data->tags = $row["tags"];


                array_push($array, $data);
            }

            $this->res->status = true;
            $this->res->respData = $array;
        } else {
            $this->res->status = false;
        }
        return $this->res;
   
    }
    public function DeleteBlogsAppData($data)
    {
        $id=$data->id;
        $sql="DELETE FROM `tbl_blog` WHERE id='$id'";
        $result = $this->con->prepare($sql);
        // var_dump($result->execute());die;
        if ($result->execute()) {
        $this->res->status = true;
        } else {
        $this->res->status = false;
        }
        return $this->res;
    }
    public function FetchFilterDataApp($data=Null)
    {
        $title=$data->title;
        $sub_title=$data->sub_title;
        $tags=$data->tags;
        $content=$data->content;
        if($data==NULL)
        {
            $sql="SELECT * FROM `tbl_blog`";
        }
        else
        {
            $sql = "SELECT * FROM `tbl_blog` WHERE `title`='$title' OR `sub_title`='$sub_title' OR `content`='$content' OR `tags`='$tags'";
        }

        $result = $this->con->prepare($sql);
        if ($result->execute()) {
            $respData = $result->fetchAll();
            $data = (object) [];
            $array = array();

            foreach ($respData as $row) {
                
                $data = (object) [];
                $data->id = $row["id"];
                $data->title = $row["title"];
                $data->sub_title = $row["sub_title"];
                $data->tags = $row["tags"];
                $data->content = $row["content"];
                array_push($array, $data);
            }

            $this->res->status = true;
            $this->res->respData = $array;
        } else {
            $this->res->status = false;
        }
        return $this->res;
   
    }
    public function EditBlogsAppData($data)
    {
        $id=$data->id;
        $sql = "select * from `tbl_blog` where id='$id'";
        $result = $this->con->prepare($sql);
        if ($result->execute()) {
            $respData = $result->fetchAll();
            $data = (object) [];
            $array = array();

            foreach ($respData as $row) {
                
                $data = (object) [];
                $data->id = $row["id"];
                $data->title = $row["title"];
                $data->sub_title = $row["sub_title"];
                $data->tags = $row["tags"];
                $data->content = $row["content"];
                array_push($array, $data);
            }

            $this->res->status = true;
            $this->res->respData = $array;
        } else {
            $this->res->status = false;
        }
        return $this->res;
   
    }

      
    public function getUserData($data)
    {
        $username = $data->username;
        $password = $data->password;
        $sql = "select * from tbl_user where ((username='$username' and Password='$password'))";

        $result = $this->con->prepare($sql);
        if ($result->execute()) {
            $number_of_rows = $result->rowCount();

            // var_dump($number_of_rows);die;
            if ($number_of_rows > 0) {
                $obj = (object) [];
                $row = $result->fetch();
                // var_dump($row);die;
                $obj->user_id = $row['user_id'];
                $obj->username = $row['username'];
               
                $this->res->user_data = $obj;
                // echo json_encode($this->res);die;
                $helperObj = new helper();
                $this->res->user_data->user_token = $helperObj->setUser($this->res, $obj->user_id);
                // echo json_encode($this->res);die;
                // var_dump($res);die;
                $this->res->status = true;

                // var_dump($res);die;

            } else {
                $this->res->status = false;
            }
        } else { //invalid username or password
            $this->res->status = false;
        }
        $res = $this->res;
        $this->res = (object) [];
        return $res;
    }
    
   



    function __destruct()
    {
        $this->con = NULL;
        $this->db->close();
    }
}


?>


