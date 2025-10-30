<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Trabajadores</h1>
    <a href="index.php?controller=trabajadores&action=create" class="btn btn-primary">Nuevo trabajador</a>
</div>

<?php if (empty($trabajadores)): ?>
    <p class="text-muted">No hay trabajadores registrados.</p>
<?php else: ?>

   <!-- (
      nombre, 
      apellido paterno, 
      apellido materno, 
      tipo de documento de identidad [considerar los valores RUC, DNI, Pasaporte], 
      número de documento de identidad, 
      sexo, 
      fecha de nacimiento, 
      departamento, 
      provincia, 
      distrito, 
      dirección
   ) -->
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Tipo de Documento</th>
                <th>Número de Documento</th>
                <th>Sexo</th>
                <th>Fecha de Nacimiento</th>
                <th>Departamento</th>
                <th>Provincia</th>
                <th>Distrito</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($trabajadores as $w): ?>
            <tr>
                <td><?= htmlspecialchars($w['nombre']) ?></td>
                <td><?= htmlspecialchars($w['apellido_paterno']) ?></td>
                <td><?= htmlspecialchars($w['apellido_materno']) ?></td>
                <td><?= htmlspecialchars($w['tipo_documento']) ?></td>
                <td><?= htmlspecialchars($w['numero_documento']) ?></td>
                <td><?= htmlspecialchars($w['sexo']) ?></td>
                <td><?= htmlspecialchars($w['fecha_nacimiento']) ?></td>
                <td><?= htmlspecialchars($w['departamento']) ?></td>
                <td><?= htmlspecialchars($w['provincia']) ?></td>
                <td><?= htmlspecialchars($w['distrito']) ?></td>
                <td><?= htmlspecialchars($w['direccion']) ?></td>
                <td>
                    <!-- <a href="index.php?controller=trabajadores&action=show&id=<?= $w['id'] ?>" class="btn btn-sm btn-outline-secondary">Ver</a> -->
                    <a href="index.php?controller=trabajadores&action=edit&id=<?= $w['id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                    <a href="index.php?controller=trabajadores&action=delete&id=<?= $w['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Eliminar trabajador?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
