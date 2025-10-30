<h2>Editar trabajador</h2>

<?php if (!$trabajador): ?>
   <div class="alert alert-danger">Trabajador no encontrado.</div>
<?php else: ?>
   <form action="index.php?controller=trabajadores&action=update" method="post">
      <input type="hidden" name="id" value="<?= htmlspecialchars($trabajador['id']) ?>">
      <div class="row">
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Nombre</label>
               <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($trabajador['nombre']) ?>" required>
            </div>
         </div>
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Apellido Paterno</label>
               <input type="text" name="apellido_paterno" class="form-control" value="<?= htmlspecialchars($trabajador['apellido_paterno']) ?>" required>
            </div>
         </div>
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Apellido Materno</label>
               <input type="text" name="apellido_materno" class="form-control" value="<?= htmlspecialchars($trabajador['apellido_materno']) ?>" required>
            </div>
         </div>
         <!-- tipo documento -->
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Tipo de Documento</label>
               <select name="tipo_documento" class="form-select" required>
                  <option value="RUC" <?= $trabajador['tipo_documento'] === 'RUC' ? 'selected' : '' ?>>RUC</option>
                  <option value="DNI" <?= $trabajador['tipo_documento'] === 'DNI' ? 'selected' : '' ?>>DNI</option>
                  <option value="Pasaporte" <?= $trabajador['tipo_documento'] === 'Pasaporte' ? 'selected' : '' ?>>Pasaporte</option>
               </select>
            </div>
         </div>
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Número de Documento</label>
               <input type="text" name="numero_documento" class="form-control" value="<?= htmlspecialchars($trabajador['numero_documento']) ?>" required>
            </div>
         </div>
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Sexo</label>
               <select name="sexo" class="form-select" required>
                  <option value="Masculino" <?= $trabajador['sexo'] === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                  <option value="Femenino" <?= $trabajador['sexo'] === 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                  <option value="Otro" <?= $trabajador['sexo'] === 'Otro' ? 'selected' : '' ?>>Otro</option>
               </select>
            </div>
         </div>
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Fecha de Nacimiento</label>
               <input type="date" name="fecha_nacimiento" class="form-control" value="<?= htmlspecialchars($trabajador['fecha_nacimiento']) ?>" required>
            </div>
         </div>
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Departamento</label>
               <select name="departamento" id="departamento" class="form-control" required>
                  <option value="">Seleccione departamento</option>
                  <?php foreach ($departamentos as $dep): ?>
                     <option value="<?= $dep['id'] ?>" <?= $trabajador['departamento_id'] == $dep['id'] ? 'selected' : '' ?>><?= htmlspecialchars($dep['descripcion']) ?></option>
                  <?php endforeach; ?>
               </select>
            </div>
         </div>
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Provincia</label>
               <select name="provincia" id="provincia" class="form-control" required>
                  <option value="">Seleccione provincia</option>
                  <?php foreach ($provincias as $prov): ?>
                     <option value="<?= $prov['id'] ?>" <?= $trabajador['provincia_id'] == $prov['id'] ? 'selected' : '' ?>><?= htmlspecialchars($prov['descripcion']) ?></option>
                  <?php endforeach; ?>
               </select>
            </div>
         </div>
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Distrito</label>
               <select name="distrito" id="distrito" class="form-control" required>
                  <option value="">Seleccione distrito</option>
                  <?php foreach ($distritos as $dist): ?>
                     <option value="<?= $dist['id'] ?>" <?= $trabajador['distrito_id'] == $dist['id'] ? 'selected' : '' ?>><?= htmlspecialchars($dist['descripcion']) ?></option>
                  <?php endforeach; ?>
               </select>
            </div>
         </div>
         <div class="col-md-4">
            <div class="mb-3">
               <label class="form-label">Dirección</label>
               <input type="text" name="direccion" class="form-control" value="<?= htmlspecialchars($trabajador['direccion']) ?>" required>
            </div>
         </div> 
      </div> 

      <button class="btn btn-primary">Actualizar</button>
      <a href="index.php?controller=trabajadores&action=index" class="btn btn-secondary">Cancelar</a>
   </form>
<?php endif; ?>