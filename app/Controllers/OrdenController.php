<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\DispositivoModel;
use App\Models\ClienteModel;
use App\Models\OrdenModel;

class OrdenController extends BaseController
{
    public function listado()
    {
        $ordenModel = new OrdenModel();
        $ordenes = $ordenModel->findAll();

        $data['ordenes'] = $ordenes;
        return view('ordenes/listado', $data);
    }

    public function crear()
    {
        $dispositivoModel = new DispositivoModel();
        $dispositivos = $dispositivoModel->obtenerDispositivosConCliente();

        // Pasar los datos a la vista
        $data['dispositivos'] = $dispositivos;

        return view('ordenes/nueva', $data);
    }

    public function buscarDispositivos()
    {
        $cedula = $this->request->getVar('cedula');

        // Buscar cliente por cédula
        $clienteModel = new ClienteModel();
        $cliente = $clienteModel->where('cedula', $cedula)->first();

        if (!$cliente) {
            // Sino se encuentra el cliente,, devolver un error
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Cliente no encontrado'
            ]);
        }

        // Buscar los dispositivos asociados al cliente por su id
        $dispositivoModel = new DispositivoModel();
        $dispositivos = $dispositivoModel->where('cliente_id', $cliente['id'])->findAll();

        // Devolver los resultados en formato JSON junto con la información del cliente
        return $this->response->setJSON([
            'success' => true,
            'cliente' => $cliente,
            'dispositivos' => $dispositivos
        ]);
    }

    public function guardarOrden()
    {
        $observaciones = $this->request->getVar('observaciones');
        $dispositivoId = $this->request->getVar('dispositivo_id');

        $ordenModel = new OrdenModel();
        $data = [
            'estado' => 'pendiente',
            'observaciones' => $observaciones,
            'dispositivo_id' => $dispositivoId
        ];

        // guardar en la base de datos
        $ordenModel->insert($data);

        // Redirigir a la página de listado de ordenes
        return redirect()->to(site_url('ordenes'));
    }

    public function actualizarEstado()
    {
        // Obtener los datos enviados por Ajax
        $ordenId = $this->request->getPost('orden_id');
        $nuevoEstado = $this->request->getPost('estado');

        // Cargar el modelo de orden
        $ordenModel = new OrdenModel();

        // Verificar si el nuevo estado es "finalizado"
        if ($nuevoEstado == 'finalizado') {
            // Obtener la fecha y hora actual
            $fechaSalida = date('Y-m-d H:i:s');

            // Actualizar el estado de la orden y la fecha de salida en la base de datos
            $ordenModel->update($ordenId, ['estado' => $nuevoEstado, 'fechaSalida' => $fechaSalida]);
        } else {
            // Si el nuevo estado no es "finalizado", actualizar solo el estado de la orden
            $ordenModel->update($ordenId, ['estado' => $nuevoEstado]);
        }

        // Enviar una respuesta (puede ser útil para manejar la confirmación en el lado del cliente)
        return $this->response->setJSON(['success' => true]);
    }
}
