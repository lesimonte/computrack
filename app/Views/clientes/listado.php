<?= $this->extend('plantilla') ?>


<?= $this->section('contenido') ?>

<div class="d-flex gap-2">
	<a class="btn btn-primary" href="<?= base_url('clientes/nuevo') ?>">Crear nuevo cliente</a>

	<form action="<?= base_url('clientes/buscar') ?>" method="get" ">
		<div class="input-group">
			<input type="text" name="busqueda" class="form-control" autocomplete="off" required>
			<button type="submit" class="btn btn-outline-primary">Buscar</button>
		</div>
	</form>
</div>

<table class="table table-hover table-sm">
	<thead>
		<th>Nombres</th>
		<th>Apellidos</th>
		<th>Cédula</th>
		<th>Telefono</th>
		<th>Email</th>
		<th>Acciones</th>
	</thead>
	<tbody>
		<?php
		foreach ($clientes as $cliente):
			?>
			<tr>
				<td>
					<?= $cliente['nombres'] ?>
				</td>
				<td>
					<?= $cliente['apellidos'] ?>
				</td>
				<td>
					<?= $cliente['cedula'] ?>
				</td>
				<td>
					<?= $cliente['telefono'] ?>
				</td>
				<td>
					<?= $cliente['email'] ?>
				</td>
				<td class="align-middle">
					<div class="btn-group gap-2">
						<form action="<?= base_url('clientes/editar/' . $cliente['id']) ?>" method="get">
							<button class="btn btn-warning btn-sm" type="submit">Editar</button>
						</form>
						<form id="delete-form-<?= $cliente['id'] ?>"
							action="<?= base_url('clientes/delete/' . $cliente['id']) ?>" method="post"
							onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
							<input type="hidden" name="_method" value="DELETE">
							<button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
						</form>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?= $this->endSection() ?>