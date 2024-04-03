<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\ResponseInterface;

use App\Models\OrdenModel;
use App\Models\ClienteModel;
use App\Models\DispositivoModel;
use App\Models\FacturaModel;

class FacturaController extends BaseController
{
    public function crear()
    {
        $ordenModel = new OrdenModel;
        $ordenesFinalizadas = $ordenModel->where('estado', 'finalizado')->findAll();

        return view('facturas/crear', ['ordenesFinalizadas' => $ordenesFinalizadas]);
    }

    public function cobrar($orden_id)
    {
        $ordenModel = new OrdenModel;
        $clienteModel = new ClienteModel;
        $dispositivoModel = new DispositivoModel;

        // Obtener detalles de la orden
        $orden = $ordenModel->find($orden_id);

        if (!$orden) {
            return redirect()->back()->with('error', 'La orden no existe o no se encontró');
        }

        // Obtener detalles del ciente asociado al dispositivo
        $dispositivo = $dispositivoModel->find($orden['dispositivo_id']);
        $cliente = $clienteModel->find($dispositivo['cliente_id']);

        if (!$cliente || !$dispositivo) {
            return redirect()->back()->with('error', 'El cliente o dispositivo no se encontró');
        }

        $data = [
            'orden' => $orden,
            'cliente' => $cliente,
            'dispositivo' => $dispositivo
        ];

        return view('facturas/cobrar', $data);
    }

    public function procesar_cobro() {
        $cantidadCobrada = $this->request->getPost('valorCobrado');
        $ordenId = $this->request->getPost('ordenId');

        // Insertar la nueva factura en la base de datos
        $facturaModel = new FacturaModel();
        $fechaFactura = date('Y-m-d H:i:s');
        $data = [
            'fechaFactura' => $fechaFactura,
            'cantidadCobrada' => $cantidadCobrada,
            'orden_id' => $ordenId
        ];

        $facturaModel->insert($data);

        // Redirigir al usuario
        return redirect()->to(site_url('facturas'))->with('success', 'La factura se ha generado correctamente');
    }
}
