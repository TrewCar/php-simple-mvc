<?php namespace App\Controllers;
use Core\Controller\BaseController;
class HomeController extends BaseController{
    public function Index() : void {
        $this->renderView("Index");
    }
    public function About() : void {
        $this->renderView("About");
    }
}