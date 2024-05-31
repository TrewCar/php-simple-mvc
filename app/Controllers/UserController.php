<?php namespace App\Controllers;
use Core\Controller\BaseController;
use App\Models\UserModel;

class UserController extends BaseController{
    public function getData($id) : void
    {
        if ($id != ((int) $id)) {
            $this->renderJson(['error' => 'Invalid user ID']);
            return;
        }
        $this->renderJson((new UserModel($id))->getInfo());
    }
}