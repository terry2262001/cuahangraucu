<?php


include_once '../Model/UserModel.php';
include_once '../until/DataValidationUtils.php';
include_once './BaseController.php';


class UserController extends BaseController
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
                $user = new UserModel("", $userLogin_txt_password, $userLogin_txt_email, "", "", "", 0, 0);
                  $data = $this->getLoginUser($user);
                if (!is_null($data)) {
                    session_start();
                    $_SESSION["username"] = $data["username"];
                    header("Location: ../view/trangchu.php");
                }else {
                    header("Location: ../view/index.php");
                    ;
                }
                break;
            case "edit":
                $id = $_GET["id"];
                $user = new UserModel("", "", " ", "", "", "", $id, 1);
                $data["user"] = $this->getUser($user);
                $data["title"] = "Sữa Thông Tin";
               // include_once '../view/edituser.php';
                return $this->view("edituser",$data);
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
                $txt_password = ($_POST["password"]);
                $txt_email = $_POST["email"];
                $txt_phone = $_POST["phone"];
                $txt_status = $_POST["status"];
                $txt_tenkhachhang = $_POST["tenkhachhang"];
                $txt_isAdmin = 0;
                if (isset($_POST["isAdmin"])) {
                    $txt_isAdmin = 1;
                }
                $user_02 = new UserModel($txt_username, $txt_password, $txt_email, $txt_phone, $txt_tenkhachhang, $txt_status, $txt_userid, $txt_isAdmin);
                $this->updateUser($user_02);
                session_start();
                // if(isset($_SESSION['username'])){
                //     unset($_SESSION['username']);
                // } 
                $_SESSION["username"] = $txt_username;
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
        $data["users"] = $this->getAllUser($user);
        $data["title"] = "Danh Sách Người Dùng";
        return $this->view('customer', $data);
        //include_once '../view/customer.php';

    }
    public function getLoginUser($user)
    {
        return $user->getLoginUser();
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