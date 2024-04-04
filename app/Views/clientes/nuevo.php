<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<div class="container">
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <h1 class="mb-2 display-6">Nuevo Cliente</h1>
            <form id="crearCliente" action="<?= base_url('clientes/guardar') ?>" method="post">

                <div class="mb-3">
                    <label for="nombres">Nombres:</label>
                    <input type="text" name="nombres" autocomplete="off" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" name="apellidos" autocomplete="off" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="cedula">Cédula:</label>
                    <input type="number" name="cedula" autocomplete="off" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="telefono">Teléfono:</label>
                    <input type="number" name="telefono" autocomplete="off" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="email" name="email" autocomplete="off" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">Crear</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>