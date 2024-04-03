<?php

namespace App\Models;

use CodeIgniter\Model;

class FacturaModel extends Model
{
    protected $table = 'facturas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fechaFactura', 'cantidadCobrada', 'orden_id'];
}
