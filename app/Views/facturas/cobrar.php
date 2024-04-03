<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<h1>Cobrar factura</h1>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h3>Detalles del cliente</h3>
            <p class="text-capitalize">Nombre:
                <?= $cliente['nombres'] ?>
                <?= $cliente['apellidos'] ?>
            </p>
            <p>
                Cédula:
                <?= $cliente['cedula'] ?>
            </p>
            <p>
                Teléfono:
                <?= $cliente['telefono'] ?>
            </p>
            <p>
                Email:
                <?= $cliente['email'] ?>
            </p>
        </div>
        <div class="col-lg-6">
            <h3>Detalles del dispositivo</h3>
            <p>
                Tipo:
                <?= $dispositivo['tipoDispositivo'] ?>
            </p>
            <p>
                Marca:
                <?= $dispositivo['marca'] ?>
            </p>
            <p>
                Modelo:
                <?= $dispositivo['modelo'] ?>
            </p>
            <p>
                Color:
                <?= $dispositivo['color'] ?>
            </p>
            <p>
                Serial:
                <?= $dispositivo['serial'] ?>
            </p>
        </div>
        <div class="col-lg-6">

            <form action="<?= site_url('facturas/procesar_cobro') ?>" method="post">
                <label for="">COP $:</label>
                <input type="number" id="valorCobrado" name="valorCobrado" class="form-control"
                    placeholder="Valor a cobrar por el servicio" required />
                <input type="hidden" name="ordenId" value="<?= $orden['id'] ?>">
                <button type="submit" class="btn btn-primary">Cobrar y generar factura</button>

            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>