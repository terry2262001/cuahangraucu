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
                $txt_tenkhachhang = $_POST["tenkhachhang"];
              
                $user_02 = new UserModel($txt_username, $txt_password, $txt_email, $txt_phone, $txt_tenkhachhang,"", 0,0);
              $data =  $this->insertUser($user_02);
                
           
               // var_dump($data);
               session_start();
               $_SESSION["username"] = $user_02->getUsername();
                header("Location: ../view/index.php");
               

                // if(!empty($txt_username) && !empty($txt_password) && !empty($txt_email)  &&!empty($txt_tenkhachhang)){
                //      $user_02 = new UserModel($txt_username, $txt_password, $txt_email, $txt_phone, $txt_tenkhachhang,"", 0);
                //      $this->insertUser($user_02);
                //     var_dump($this->insertUser($user_02));
                   
                //     }else{
                //     echo "cc";
                
                // }
            


             
                // $mesage = $this->insertUser($user_02);
              //  var_dump($this->insertUser($user_02));
              ///  exit();
                

                // session_start();
                //         $_SESSION["username"] = $user_02->getUsername();
                //         header("Location: ../view/index.php");

                break;
            case "user_login":
                $userLogin_txt_email = $_POST["email"];
                $userLogin_txt_password = md5($_POST["password"]);
                //  if ($this->dataValid($userLogin_txt_email, $userLogin_txt_password)) {

                //  $user = isUserValid($userLogin_txt_email, $userLogin_txt_password, $arrUsers);
                $user = new UserModel("", $userLogin_txt_password, $userLogin_txt_email, "", "", "", 0,0);
                $this->getUser($user);
                $data = $this->getUser($user);
                if(count($data)){
                    for ($i = 0; $i < count($data); $i++) {
                        //    $user2 = new UserModel($data[$i]["username"], $data[$i]["password"], $data[$i]["email"], $data[$i]["phone"], $data[$i]["fullname"],$data[$i]["fullname"]   ,0);
                            $user->setUsername($data[$i]["username"]);
                            $user->setPassword($data[$i]["password"]);
                            $user->setEmail($data[$i]["email"]);
                            $user->setUserid($data[$i]["userid"]);
                        }
                        session_start();
                        $_SESSION["username"] = $user->getUsername();
                        header("Location: ../view/index.php");
                }else{
                    header("Location: ../view/login.php");;
                }
              
                break;
                
            // default:
            //     //$this->showUserPage();
            //     header("Location: ../view/index.php");
            //     break;

        }


    }
    public function dataValid($email, $pass)
    {
        $validData = new DataValidationUtils();
        return $validData->checkEmailValid($email); // && $validData->checkPasswordValid($pass);
    }
    public function insertUser($user)
    {
       return $user->insertUser();

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