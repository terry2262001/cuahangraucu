<?php


include_once '../Model/UserModel.php';
include_once '../until/DataValidationUtils.php';


class UserController
{
    public function __construct($user_action)
    {
        switch ($user_action) {
            case "user_create":
                $txt_username = $_POST["username"];
                $txt_password = md5($_POST["password"]);
                $txt_email = $_POST["email"];
                $txt_phone = $_POST["phone"];
                $txt_status = $_POST["status"];
                $txt_tenkhachhang = $_POST["tenkhachhang"];


                $user_02 = new UserModel($txt_username, $txt_password, $txt_email, $txt_phone, $txt_tenkhachhang, $txt_status, 0);
                $this->insertUser($user_02);
                header("Location: ../controller/UserController.php");

                break;
            case "user_login":
                $userLogin_txt_email = $_POST["email"];
                $userLogin_txt_password = md5($_POST["password"]);


                //  if ($this->dataValid($userLogin_txt_email, $userLogin_txt_password)) {

                //  $user = isUserValid($userLogin_txt_email, $userLogin_txt_password, $arrUsers);
                $user = new UserModel("", $userLogin_txt_password, $userLogin_txt_email, "", "", "", 0);
                $this->getUser($user);
                var_dump($this->getUser($user));
                $arrrUser = array();
                $arrrUser = $this->getUser($user);
                $user_02 = new UserModel("", "", "", "", "", "", 0);
                $user_02 = (object) $arrrUser();
               var_dump($user_02);
                // $user444 = new UserModel($arrrUser);
                // $userDetail = null;
                // foreach ($arrrUser as $user1) {
                //      foreach($user1 as $key=>$value){
                //         var_dump($value);

                //      }
                    
                
                 

                //   }

        
                exit();
                if ($user->getPassword() == $userLogin_txt_password && $user->getEmail() == $userLogin_txt_email) {
                    session_start();
                    $_SESSION["username"] = $this->getUser($user)->getUsername;
                    $_SESSION["is_login"] = true;


                    //  header("Location: ../controller/UserController.php");
                    header("Location: ../view/index.php");
                }
                // } else {
                //     echo " Du Lieu Khong Hop Le !";
                // }
                break;
            default:
                //$this->showUserPage();
                header("Location: ../view/index.php");
                break;

        }


    }
    public function dataValid($email, $pass)
    {
        $validData = new DataValidationUtils();
        return $validData->checkEmailValid($email); // && $validData->checkPasswordValid($pass);
    }
    public function insertUser($user)
    {
        $user->insertUser();

    }
    public function updateUser($user)
    {
        $user->updateUser();

    }
    public function deleteUser($user)
    {
        $user->deleteUser();

    }
    public function getUser($user)
    {
        return $user->getUser();

    }
    public function getAllUser($user)
    {
        return $user->getAllUser();

    }
    public function showUserPage()
    {
        $user = new UserModel("", "", "", "", "", "", 0);
        $data = $this->getUser($user);
        include_once '../view/index.php';

    }


}

$user_action = "";
if (count($_POST) > 0) {
    $user_action = $_POST["user_action"];
}
$userControl = new UserController($user_action);








?>