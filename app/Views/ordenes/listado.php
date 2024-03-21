<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<h1>Dahsboard de las ordenes </h1>

<a class="btn btn-success" href="<?= site_url('ordenes/nueva') ?>">Generar nueva orden</a>

<div class="container">
    <div class="row">
        <div class="col-lg-4 border p-2">
            <h4>Por hacer</h4>

            <?php foreach ($ordenes as $orden): ?>
                <div class="card">
                    <h5 class="card-header">
                        <?= $orden['dispositivo_id'] ?>
                    </h5>
                    <div class="card-body">
                        <p class="card-text">
                            <?= $orden['observaciones'] ?>
                        </p>
                        <span class="badge rounded-pill text-bg-primary">
                            <?= $orden['fechaIngreso'] ?>
                        </span>
                        <select name="" id="" class="form-select">
                            <option value="pendiente">Pendiente</option>
                            <option value="enCurso">En Curso</option>
                            <option value="finalizado">Finalizado</option>
                        </select>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-lg-4 border">
            <h4>En progreso</h4>
        </div>
        <div class="col-lg-4 border">
            <h4>Finalizado</h4>
        </div>
    </div>
</div>


<?= $this->endSection() ?>