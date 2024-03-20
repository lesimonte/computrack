<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>


<a class="btn btn-success" href="">Generar nueva orden</a>

<div class="container">
    <div class="row">
        <div class="col-lg-4 border">
            <h4>Por hacer</h4>
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