<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <a class="btn btn-primary mb-3" href="<?= base_url('clientes/nuevo') ?>">Crear nuevo cliente</a>
        </div>
        <div class="col-12">
            <form action="<?= base_url('clientes/buscar') ?>" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" name="busqueda" class="form-control" placeholder="Buscar cliente..." autocomplete="off" required>
                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive"> <!-- Agregamos esta clase para hacer la tabla responsive -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Cédula</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= $cliente['nombres'] ?></td>
                            <td><?= $cliente['apellidos'] ?></td>
                            <td><?= $cliente['cedula'] ?></td>
                            <td><?= $cliente['telefono'] ?></td>
                            <td><?= $cliente['email'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <form action="<?= base_url('clientes/editar/' . $cliente['id']) ?>" method="get">
                                        <button class="btn btn-warning btn-sm" type="submit">Editar</button>
                                    </form>
                                    <form id="delete-form-<?= $cliente['id'] ?>" action="<?= base_url('clientes/delete/' . $cliente['id']) ?>" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
