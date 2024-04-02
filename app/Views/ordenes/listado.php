
<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<h1>Dashboard de las órdenes</h1>

<a class="btn btn-success" href="<?= site_url('ordenes/nueva') ?>">Generar nueva orden</a>

<div class="container">
	<div class="row">
		<?php foreach (['pendiente', 'enCurso', 'finalizado'] as $estado): ?>
			<div class="col-lg-4 border p-2">
				<h4>
					<?= ucfirst($estado) ?>
				</h4>

				<?php foreach ($ordenes as $orden): ?>
					<?php if ($orden['estado'] == $estado): ?>
						<div class="card">
							<h5 class="card-header">
								<?= $orden['dispositivo_id'] ?>
							</h5>
							<div class="card-body">
								<p class="card-text">
									<?= $orden['observaciones'] ?>
								</p>
								<span class="badge rounded-pill 
																								<?php if ($orden['estado'] == 'pendiente'): ?>text-bg-warning
																								<?php elseif ($orden['estado'] == 'enCurso'): ?>text-bg-primary
																								<?php elseif ($orden['estado'] == 'finalizado'): ?>text-bg-success
																								<?php endif; ?>">
									<?= $orden['fechaIngreso'] ?>
								</span>
								<?php if ($orden['estado'] != 'finalizado'): ?>
									<select name="estado" class="form-select estado-select" data-orden-id="<?= $orden['id'] ?>"
										onchange="actualizarEstado(<?= $orden['id'] ?>, this.value)">
										<option value="pendiente" <?= ($orden['estado'] == 'pendiente') ? 'selected' : '' ?>>Pendiente</option>
										<option value="enCurso" <?= ($orden['estado'] == 'enCurso') ? 'selected' : '' ?>>En Curso</option>
										<option value="finalizado" <?= ($orden['estado'] == 'finalizado') ? 'selected' : '' ?>>Finalizado</option>
									</select>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('.estado-select').change(function () {
			var ordenId = $(this).data('orden-id');
			var nuevoEstado = $(this).val();

			$.ajax({
				type: "POST",
				url: "<?= site_url('ordenes/actualizar_estado') ?>",
				data: { orden_id: ordenId, estado: nuevoEstado },
				success: function (response) {
					if (response.success) {
						location.reload(); // Recargar la página después de actualizar el estado
					} else {
						console.log("Error al actualizar el estado.");
					}
				},
				error: function () {
					console.log("Error de conexión.");
				}
			});
		});
	});
</script>

<?= $this->endSection() ?>
