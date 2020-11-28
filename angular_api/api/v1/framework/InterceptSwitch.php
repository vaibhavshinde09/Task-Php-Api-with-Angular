<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '' . url_config . 'framework/controller/adminController.php');

class Interceptor
{

    public function __construct()
    {

    }



    public function common($endPoint, $data = NULL)
    {

        $adminController = new AdminController();
        switch ($endPoint) {
            case 'login': {
                    $response = $adminController->login($data);
                    break;
                }
                case 'user_registr':
                    {
                        $response = $adminController->UserRegistration($data);
                        break;
               
                    }
                
            default: {
                }
        }
        return $response;
    }

    public function user($endPoint, $data = NULL)
    {
        //var_dump(($data));die;
        $admController = new AdminController();
        switch ($endPoint) {
           
            default: {
                }
        }
        return;
    }
  
    public function admin($endPoint, $data = NULL)
    {
        $admController = new AdminController();
        switch ($endPoint) {
            case 'createblogs':
                {
                    $response = $admController->CreateBlogsApp($data);
                    break;
           
                }
                case 'updateblogs':
                    {
                        $response = $admController->UpdateBlogsApp($data);
                        break;
               
                    }
                    case 'viewblogs':
                        {
                            $response = $admController->ViewBlogsApp();
                            break;
                   
                        }
                        case 'Deleteblogs':
                            {
                                $response = $admController->DeleteBlogsApp($data);
                                break;
                       
                            }
                        case 'edit_blog_data':
                            {
                                $response = $admController->EditBlogsApp($data);
                                break;
                       
                            }
                        case 'fetch_fliter_data':
                            {
                                $response = $admController->FetchFilterData($data);
                                break;
                       
                            }
                      
                                   
            

            default: {
                }
        }

        return $response;
    }

    function __destruct()
    {
        session_unset();
    }
}
