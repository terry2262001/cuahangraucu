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
                $txt_isAdmin = 0;
                if (isset($_POST["isAdmin"])) {
                    $txt_isAdmin = 1;
                }
                $user_02 = new UserModel($txt_username, $txt_password, $txt_email, $txt_phone, $txt_tenkhachhang, $txt_status, 0, $txt_isAdmin);
                $this->insertUser($user_02);
                header("Location: ../controller/UserController.php");
                break;
            case "user_login":
                $userLogin_txt_email = $_POST["email"];
                $userLogin_txt_password = md5($_POST["password"]);


                //  if ($this->dataValid($userLogin_txt_email, $userLogin_txt_password)) {

                //  $user = isUserValid($userLogin_txt_email, $userLogin_txt_password, $arrUsers);
                $user = new UserModel("", $userLogin_txt_password, $userLogin_txt_email, "", "", "", 0, 1);
                if ($user->getPassword() == $userLogin_txt_password && $user->getEmail() == $userLogin_txt_email) {
                    session_start();
                    $_SESSION["email"] = $userLogin_txt_email;
                    $_SESSION["is_login"] = true;
                    header("Location: ../controller/UserController.php");
                }
                // } else {
                //     echo " Du Lieu Khong Hop Le !";
                // }
                break;
            case "edit":
                $id = $_GET["id"];
                $user = new UserModel("", "", " ", "", "", "", $id, 1);
                $data = $this->getUser($user);
                include_once '../view/edituser.php';

                break;
            case "delete":
                $id = $_GET["id"];
                $user = new UserModel("", "", " ", "", "", "", $id, "");
                $data = $this->deleteUser($user);
                $this->showUserPage();

                break;
            case "user_update":
                $txt_userid = $_POST["userid"];
                $txt_username = $_POST["username"];
                $txt_password = md5($_POST["password"]);
                $txt_email = $_POST["email"];
                $txt_phone = $_POST["phone"];
                $txt_status = $_POST["status"];
                $txt_tenkhachhang = $_POST["tenkhachhang"];
                $txt_isAdmin = 0;
                if (isset($_POST["isAdmin"])) {
                    $txt_isAdmin = 1;
                }
                $user_02 = new UserModel($txt_username,$txt_password, $txt_email, $txt_phone, $txt_tenkhachhang, $txt_status, $txt_userid, $txt_isAdmin);
                $this->updateUser($user_02);
                $this->showUserPage();
                break;
            case "user_delete":
                echo 'delete';
                break;
            default:
                $this->showUserPage();
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
        return $user->deleteUser();

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
        $user = new UserModel("", "", "", "", "", "", 0, false);
        $data = $this->getAllUser($user);
        include_once '../view/customer.php';

    }


}

$user_action = "";
if (count($_POST) > 0) {
    $user_action = $_POST["user_action"];
} else if (count($_GET) > 0) {
    $user_action = $_GET["action"];
}

$userControl = new UserController($user_action);










?>