<?php

namespace App\Controllers;
use App\Models\ClienteModel;

class ClienteController extends BaseController
{
    public function listado() {
        $modelo = new ClienteModel();
        $datos['clientes'] = $modelo->findAll();

        return view('clientes/listado', $datos);
    }

    public function delete($id = null)
    {
        $modelo = new ClienteModel();
        $modelo -> delete($id);

        return redirect()->to('/clientes');
    }

    public function crear(){
        return view('clientes/nuevo');
    }

    public function guardar() {
        $modelo = new ClienteModel();
        $datos = [
            'nombres' => $this->request->getVar('nombres'),
            'apellidos' => $this->request->getVar('apellidos'),
            'cedula' => $this->request->getVar('cedula'),
            'telefono' => $this->request->getVar('telefono'),
            'email' => $this->request->getVar('email'),
        ];
        $modelo -> insert($datos);
        return redirect()->to('/clientes');
    }

    public function editar($id) {
        $modelo = new ClienteModel();
        $datos['cliente'] = $modelo->find($id);

        return view('clientes/editar', $datos);
    }

    public function actualizar($id) {
        $modelo = new ClienteModel();

        $datos = [
            'nombres' => $this->request->getVar('nombres'),
            'apellidos' => $this->request->getVar('apellidos'),
            'cedula' => $this->request->getVar('cedula'),
            'telefono' => $this->request->getVar('telefono'),
            'email' => $this->request->getVar('email'),
        ];

        $modelo->update($id, $datos);
        return redirect()->to('/clientes');
    }

    public function buscar() {
        $modelo = new ClienteModel();

        // Obtener el término de búsqueda de la URL
        $peticion = $this->request->getVar('busqueda');

        // Realizar la búsqueda en el modelo de Cliente
        $clientes = $modelo->like('nombres', $peticion)
                            ->orLike('apellidos', $peticion)
                            ->orLike('cedula', $peticion)
                            ->orLike('telefono', $peticion)
                            ->orLike('email', $peticion)
                            ->findAll();

        // Pasar los resultados de la búsqueda a la vista
        return view('clientes/listado', ['clientes' => $clientes]);
    }
}