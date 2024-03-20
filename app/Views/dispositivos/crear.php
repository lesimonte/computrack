<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<h1 class="display-6">Crear Dispositivo</h1>

<div class="container">
    <form action="<?= site_url('dispositivos/guardar') ?>" method="post">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3 form-group">
                    <label for="tipoDispositivo">Tipo Dispositivo: </label>
                    <select class="form-control" name="tipoDispositivo" id="tipoDispositivo" required>
                        <option value="portatil">Portátil</option>
                        <option value="torre">Torre</option>
                        <option value="celular">Celular</option>
                        <option value="pantalla">Pantalla</option>
                        <option value="consola">Consola</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="mb-3 form-group">
                    <label for="marca">Marca: </label>
                    <input type="text" name="marca" id="marca" autocomplete="off" class="form-control" required>
                </div>
                <div class="mb-3 form-group">
                    <label for="modelo">Modelo: </label>
                    <input type="text" name="modelo" id="modelo" autocomplete="off" class="form-control" required>
                </div>
                <div class="mb-3 form-group">
                    <label for="color">Color: </label>
                    <input type="text" name="color" id="color" autocomplete="off" class="form-control">
                </div>
                <div class="mb-3 form-group">
                    <label for="serial">Serial: </label>
                    <input type="text" name="serial" id="serial" autocomplete="off" class="form-control" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3 form-group">
                    <label for="serial">Diagnóstico: </label>
                    <textarea class="form-control" id="diagnostico" name="diagnostico" rows="4"
                        autocomplete="off"></textarea>
                </div>
                <div class="mb-3 form-group">
                    <label for="buscarCliente">Buscar Cliente (Cédula): </label>
                    <input autocomplete="off" type="text" id="buscarCliente" class="form-control"
                        placeholder="Buscar cliente por cédula..." required>
                </div>
                <div class="mb-3 form-group">
                    <label for="nombreCliente">Cliente: </label>
                    <input type="text" id="nombreCliente" class="form-control" disabled>
                </div>
                <input type="hidden" id="clienteId" name="clienteId">
                <!-- Hidden input para almacenar el id del cliente -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <button class="btn btn-success" type="submit">Registrar Dispositivo</button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Evento de cambio en el campo de búsqueda de clientes
        $('#buscarCliente').on('input', function(event) {
            let terminoBusqueda = $(this).val();

            // Obtener el nombre del cliente correspondiente a la cédula registrada
            $.ajax({
                url: '<?= site_url('dispositivos/obtenerNombreClientePorCedula') ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    cedula: terminoBusqueda
                },
                success: function (response) {
                    $('#nombreCliente').val(response.nombreCompleto);
                    $('#clienteId').val(response
                        .clienteId); // Actualizar el valor del clienteId
                },
                error: function() {
                    $('#nombreCliente').val('');
                    $('#clienteId').val(''); // Limpiar el valor del clienteId sino se encuentra el cliente
                }
            })

        })
    });
</script>



<?= $this->endSection() ?>