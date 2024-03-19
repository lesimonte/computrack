<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<div class="container">
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <h1 class="mb-2 display-6">Editar Cliente</h1>
            <form action="<?= base_url('clientes/actualizar/' . $cliente['id']) ?>" method="post">

                <div class="mb-3">
                    <label for="nombres">Nombres:</label>
                    <input type="text" name="nombres" autocomplete="off" class="form-control" value="<?= $cliente['nombres']?>">
                </div>

                <div class="mb-3">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" name="apellidos" autocomplete="off" class="form-control" value="<?= $cliente['apellidos']?>">
                </div>

                <div class="mb-3">
                    <label for="cedula">Cédula:</label>
                    <input type="number" name="cedula" autocomplete="off" class="form-control" value="<?= $cliente['cedula']?>">
                </div>

                <div class="mb-3">
                    <label for="telefono">Teléfono:</label>
                    <input type="number" name="telefono" autocomplete="off" class="form-control" value="<?= $cliente['telefono']?>">
                </div>

                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="email" name="email" autocomplete="off" class="form-control" value="<?= $cliente['email']?>">
                </div>

                <button type="submit" class="btn btn-warning w-100">Actualizar</button>
            </form>
        </div>
    </div>
</div>



<?= $this->endSection() ?>