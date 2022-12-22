<?php
include_once '../Model/Product.php';
include_once './BaseController.php';

class OrderController extends BaseController
{
    public function __construct($order_action)
    {
        switch ($order_action) {
            case "add":
                $productID= $_POST["product_id"];
                $product = new Product( $productID,"", "", "", 0);
                $data = $this->getProduct($product);
                $product1 = new Product( $data["id"],$data["name"],$data["image"],$data["price"],1);
            
                if(!empty($_SESSION["cart_item"])){
                    if(array_key_exists($productID,$_SESSION["cart_item"])){
                         $num = $_SESSION["cart_item"][$productID]->getNumber();
                         $_SESSION["cart_item"][$productID]->setNumber($num + 1);
                     
                    }else{
                        $_SESSION["cart_item"][$productID] = $product1;
                    }
                  
                }
                else{
                    $_SESSION["cart_item"][$productID] = $product1;

                }
                header("Location: OrderController.php");
                break;
            case "clear":
                unset($_SESSION);
                session_destroy();
                header("Location: OrderController.php");
                break;
            case "checkout":
                $data["cart"] = $_SESSION["cart_item"];
                $this->view("shopingcart", $data);
                    break;
            default:
                $product = new Product("", "", "", "", 0);
                $data["products"] = $this->getAllProduct($product);
                $this->view("index", $data);
                break;

        }


    }
    public function getAllProduct($product)
    {
        return $product->getAllProducts();

    }
    public function getProduct($product){
        return $product->getProduct();

    }

}
session_start();
$order_action = "";
if (count($_POST) > 0) {
    $order_action = $_POST["order_action"];
}else if(isset($_GET['action'])){
    $order_action = $_GET['action'];

}

$orderControl = new OrderController($order_action);