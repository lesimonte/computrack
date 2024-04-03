
<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<h1>Generar factura</h1>

<table class="table table-hover table-sm">
	<thead>
        <th>Fecha ingreso</th>
        <th>Observaciones</th>
        <th>Acciones</th>
	</thead>
	<tbody>
		<?php
		foreach ($ordenesFinalizadas as $ordenFinalizada):
			?>
			<tr>
				<td>
					<?= $ordenFinalizada['fechaIngreso'] ?>
				</td>
				<td>
					<?= $ordenFinalizada['observaciones'] ?>
				</td>
				<td>
					<a href="<?= site_url('facturas/cobrar/' . $ordenFinalizada['id'])?>" class="btn btn-success">
						Cobrar
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?= $this->endSection() ?>
