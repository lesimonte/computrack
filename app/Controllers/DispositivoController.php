<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ClienteModel;
use App\Models\DispositivoModel;

class DispositivoController extends BaseController
{
    public function listado()
    {
        $dispositivoModel = new DispositivoModel();

        // Obtener los dispositivos con clientes paginados
        $dispositivos = $dispositivoModel->obtenerDispositivosConCliente();

        // Pasar los datos y la paginación a la vista
        $data['dispositivos'] = $dispositivos;
        $data['pager'] = $dispositivoModel->pager;
        return view ('dispositivos/listado', $data);
    }

    public function crear() {
        return view('dispositivos/crear');
    }

    public function obtenerClientes() {
        $clienteModel = new ClienteModel();
        $clientes = $clienteModel->findAll();

        return json_encode($clientes);
    }

    public function obtenerNombreClientePorCedula() {
        $cedula = $this->request->getVar('cedula');
        // Lógica para buscar el nombre y el ID del cliente por su cédula en el modelo cliente
        $clienteModel = new ClienteModel();
        $cliente = $clienteModel->where('cedula', $cedula)->first();

        if($cliente){
            $nombreCompleto = $cliente['nombres'] . ' ' . $cliente['apellidos'];
            $clienteId = $cliente['id'];
        }
        else{
            $nombreCompleto = '';
            $clienteId = 0; // 0 porque no se encontró cliente
        }

        // Devolver el nombre del cliente y su ID como una respuesta JSON
        return $this->response->setJSON(['nombreCompleto' => $nombreCompleto, 'clienteId' => $clienteId]);
    }

    public function registrarDispositivo()
    {
        // Obtener los datos del dispositivo
        $tipoDispositivo = $this->request->getVar('tipoDispositivo');
        $marca = $this->request->getVar('marca');
        $modelo = $this->request->getVar('modelo');
        $color = $this->request->getVar('color');
        $serial = $this->request->getVar('serial');
        $diagnostico = $this->request->getVar('diagnostico');
        $clienteId = $this->request->getVar('clienteId');

        // Guardar los datos del dispositivo en la base de datos
        $dispositivoModel = new DispositivoModel();
        $data = [
            'tipoDispositivo' => $tipoDispositivo,
            'marca' => $marca,
            'modelo' => $modelo,
            'color' => $color,
            'serial' => $serial,
            'diagnostico' => $diagnostico,
            'cliente_id' => $clienteId
        ];
        $dispositivoModel->insert($data);

        // Redirigir a la página
        return redirect()->to('dispositivos');
    }

    public function borrar($id = null)
    {
        $dispositivoModel = new DispositivoModel();
        $dispositivoModel ->delete($id);

        return redirect()->to('/dispositivos');
    }
}