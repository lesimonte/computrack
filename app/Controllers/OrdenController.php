<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ordenController extends BaseController
{
    public function listado()
    {
        return view('ordenes/listado');
    }
}
