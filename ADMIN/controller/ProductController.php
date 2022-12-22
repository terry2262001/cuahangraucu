<?php
include_once '../Model/Product.php';
include_once './BaseController.php';

class ProductController extends BaseController
{
    public function __construct($product_action)
    {
        switch ($product_action) {
            case "product_create":
                $name = $_POST["name"];
                $price = $_POST["price"];
                $filename = $_FILES['filess']['name'];

                $target_file = './PICTURE/' . $filename[0];
                $file_extension = pathinfo(
                    $target_file,
                PATHINFO_EXTENSION
                );
                $file_extension = strtolower($file_extension);
                $valid_extension = array("png", "jpeg", "jpg");

                if (in_array($file_extension, $valid_extension)) {
                    // Upload file
                    if (move_uploaded_file($_FILES['filess']['tmp_name'][0], $target_file)) {
                        $product_01 = new Product("",$name, './PICTURE/' . $filename[0], $price);


                        $this->insertProduct($product_01);

                         header("Location: ../controller/UserController.php");
                        exit;
                    }
                }



                break;

            case "edit":
                $id = $_GET["id"];
                $user = new UserModel("", "", " ", "", "", "", $id, 1);
                $data["user"] = $this->getUser($user);
                $data["title"] = "Sửa Thông Tin";
                // include_once '../view/edituser.php';
                return $this->view("edituser", $data);
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
    public function insertProduct($product)
    {
        return $product->insertProduct();
    }
}
$product_action = "";
if (count($_POST) > 0) {
    $product_action = $_POST["product_action"];
} else if (count($_GET) > 0) {
    $product_action = $_GET["action"];
}

$productControl = new ProductController($product_action);

?>