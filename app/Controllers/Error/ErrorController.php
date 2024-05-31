<?php

namespace App\Controllers\Error;

use Core\Controller\BaseController;
use Core\Controller\IErrorController;
use Core\Data\Constant;

class ErrorController extends BaseController implements IErrorController
{
    public function err404() : void
    {
        $this->renderView('Error/404');
    }
}