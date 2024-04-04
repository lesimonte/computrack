<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<div class="container mt-4">
	<h1>Listado de Dispositivos</h1>
	<a class="btn btn-success mb-3" href="<?= base_url('dispositivos/nuevo') ?>">Nuevo Dispositivo</a>
	<div class="table-responsive"> <!-- Agregamos esta clase para hacer la tabla responsive -->
		<table class="table table-hover table-sm">
			<thead>
				<tr>
					<th>Tipo Dispositivo</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Color</th>
					<th>Serial</th>
					<th>Diagnóstico</th>
					<th>Cliente</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($dispositivos as $dispositivo): ?>
					<tr>
						<td>
							<?= $dispositivo['tipoDispositivo'] ?>
						</td>
						<td>
							<?= $dispositivo['marca'] ?>
						</td>
						<td>
							<?= $dispositivo['modelo'] ?>
						</td>
						<td>
							<?= $dispositivo['color'] ?>
						</td>
						<td>
							<?= $dispositivo['serial'] ?>
						</td>
						<td>
							<?= $dispositivo['diagnostico'] ?>
						</td>
						<td>
							<?= $dispositivo['nombreCompleto'] ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?= $this->endSection() ?>