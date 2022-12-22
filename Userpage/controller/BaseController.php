<?php
class BaseController {
    public function view($name,$data=[]){
        include_once "../view/" . $name . ".php";
    }


}