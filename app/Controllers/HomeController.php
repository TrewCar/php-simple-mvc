<?php namespace App\Controllers;
use Core\Controller\BaseController;
class HomeController extends BaseController{
    public function Index(){
        $this->renderView("Index");
    }
    public function About(){
        $this->renderView("About");
    }
}