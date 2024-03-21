<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<h1>Nueva orden </h1>

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="">Cédula</label>
                <input type="text" id="cedula" class="form-control" autocomplete="off">
                <button id="btnBuscarCliente" class="btn btn-primary">Buscar cliente</button>
            </div>
        </div>
        <div class="col-lg-8">
            <h3 id="nombreCliente">nombreCliente</h3>
        </div>
    </div>
    <div class="row mt-4">
        <table id="tablaDispositivos" class="table table-hover table-sm table-primary">
            <thead>
                <th>Tipo de Dispositivo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Serial</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <!-- Aquí se llenarán los datos dinámicamente -->
            </tbody>
        </table>
    </div>

    <form action="<?= site_url('ordenes/guardarOrden') ?>" method="post" id="formularioOrden">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="4" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Dispositivo</label>
                    <span class="badge text-bg-info" id="dispositivoSeleccionado"></span>
                    <!-- Agregar un campo oculto para almacenar el ID del dispositivo -->
                    <input type="hidden" name="dispositivo_id" id="dispositivo_id">
                </div>
            </div>
        </div>

        <!-- Enviar los datos y crear la orden -->
        <button type="submit" class="btn btn-warning mt-2">Registrar nueva orden al sistema</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('table#tablaDispositivos tbody').on('click', 'button.btn-success', function () {
            let idDispositivo = $(this).closest('tr').attr('data-id');
            let tipoDispositivo = $(this).closest('tr').find('td:eq(0)').text();
            let serial = $(this).closest('tr').find('td:eq(4)').text();

            // Llenar el span con la información del dispositivo seleccionado
            $('#dispositivoSeleccionado').text(tipoDispositivo + ' | ' + serial);

            // Almacenar el ID del dispositivo seleccionado
            $('#dispositivo_id').val(idDispositivo);
        });

        // Evento de clic en el botón "Buscar cliente"
        $('button#btnBuscarCliente').on('click', function () {
            let cedula = $('input#cedula').val();

            // Enviar la solicitud AJAX al controlador para buscar los dispositivos asociados al cliente
            $.ajax({
                url: '<?= site_url('ordenes/buscarDispositivos') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    cedula: cedula
                },
                success: function (response) {
                    if (response.success) {
                        // Mostrar el nombre del cliente
                        $('h3#nombreCliente').text(response.cliente.nombres + ' ' + response.cliente.apellidos);

                        // Limpiar la tabla de dispositivos
                        $('table#tablaDispositivos tbody').empty();

                        // Mostrar los dispositivos asociados al cliente en la tabla
                        $.each(response.dispositivos, function (index, dispositivo) {
                            $('table#tablaDispositivos tbody').append('<tr data-id="' + dispositivo.id + '"><td>' + dispositivo.tipoDispositivo + '</td><td>' + dispositivo.marca + '</td><td>' + dispositivo.modelo + '</td><td>' + dispositivo.color + '</td><td>' + dispositivo.serial + '</td><td><button class="btn btn-success">Seleccionar</button></td></tr>');
                        });
                    } else {
                        // Si ocurrió un error, mostrar un mensaje de error
                        alert(response.message);
                    }
                },
                error: function () {
                    // Si ocurrió un error en la solicitud AJAX, mostrar un mensaje de error
                    alert('Error al buscar dispositivo');
                }
            })
        })

    })
</script>

<?= $this->endSection() ?>