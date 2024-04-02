<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\OrdenModel;

class FacturaController extends BaseController
{
    public function crear()
    {
        $ordenModel = new OrdenModel;
        $ordenesFinalizadas = $ordenModel->where('estado', 'finalizado')->findAll();

        return view('facturas/crear', ['ordenesFinalizadas' => $ordenesFinalizadas]);
    }
}
