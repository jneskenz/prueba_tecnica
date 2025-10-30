<h2>Crear trabajador</h2>

<form id="formTrabajador" action="index.php?controller=trabajadores&action=store" method="post">
   <div class="row">
      <div class="col-md-4">
         <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required minlength="2" maxlength="50">
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label class="form-label">Apellido Paterno</label>
            <input type="text" name="apellido_paterno" class="form-control" required minlength="2" maxlength="50">
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label class="form-label">Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form-control" required minlength="2" maxlength="50">
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label class="form-label">Tipo de Documento</label>
            <!-- <input type="text" name="tipo_documento" class="form-control" required> -->
            <select name="tipo_documento" class="form-control" required>
               <option value="">Seleccione</option>
               <option value="RUC">RUC</option>
               <option value="DNI">DNI</option>
               <option value="Pasaporte">Pasaporte</option>
            </select>
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label class="form-label">Número de Documento</label>
            <input type="text" name="numero_documento" class="form-control" required >
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label class="form-label">Sexo</label>
            <select name="sexo" class="form-control" required>
               <option value="">Seleccione</option>
               <option value="masculino">Masculino</option>
               <option value="femenino">Femenino</option>
            </select>
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" required>
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label class="form-label">Departamento</label>
            <select name="departamento" id="departamento" class="form-control" required>
               <option value="">Seleccione departamento</option>
               <?php foreach ($departamentos as $dep): ?>
                  <option value="<?= htmlspecialchars($dep['id']) ?>"><?= htmlspecialchars($dep['descripcion']) ?></option>
               <?php endforeach; ?>
            </select>
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label class="form-label">Provincia</label>
            <select name="provincia" id="provincia" class="form-control" required disabled>
               <option value="">Seleccione provincia</option>
            </select>
         </div>
      </div>
      <div class="col-md-4">
         <div class="mb-3">
            <label class="form-label">Distrito</label>
            <select name="distrito" id="distrito" class="form-control" required disabled>
               <option value="">Seleccione distrito</option>
            </select>
         </div>
      </div>
      <div class="col-md-4">

         <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" required minlength="5" maxlength="200">
         </div>
      </div>
   </div>

   <button class="btn btn-success">Crear</button>
   <a href="index.php?controller=trabajadores&action=index" class="btn btn-secondary">Cancelar</a>
</form>

