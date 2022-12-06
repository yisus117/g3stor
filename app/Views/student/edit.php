<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Editar estudiante: <?= $student->primer_nombre ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url(route_to("students")) ?>">Estudiantes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar</li>
  </ol>
</nav>
<?= $this->endSection() ?>

<section class="section min-vh-100">

  <div class="container">

    <div class="form-body">
      <div class="row">
        <div class="form-holder">
          <div class="form-content container">
            <div class="form-items" style="background-color: <?= config("G3stor")->mainColor ?>;">
              <h3 class="mb-4 fw-normal">Editar estudiante: "<?= $student->primer_nombre ?> <?= $student->primer_apellido  ?>"</h3>
              <form class="requires-validation" novalidate action="<?= base_url(route_to("students_update")) ?>" method="POST">

              <div class="row">
              <div class="col-md-6 mb-4">
                    <label class="label fs-6">ID de registro</label>
                    <input readonly  class="form-control mt-1 " type="text" name="id_student" value="<?= old("id_student") ?? $student->id_estudiante ?>" required>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6"># documento:</label>
                    <input readonly  class="form-control mt-1 " type="text" name="document" value="<?= old("document") ?? $student->documento ?>" required>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.document") ?></small>

                  </div>

                </div>

              <input type="hidden" class="form-control mt-1" name="id_student" value="<?= $student->id_estudiante ?>" required>

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-group">
                      <label class="label req fs-6">Primer Nombre:</label>
                      <input class="form-control mt-1 " type="text" name="first_name" value="<?= old("first_name") ?? $student->primer_nombre ?>" placeholder="Ingrese el nombre" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    </div>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.firstname_name") ?></small>

                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Segundo Nombre: <small class="text-secondary">(Opcional)</small></label>
                    <input class="form-control mt-1 " type="text" name="second_name" value="<?= old("second_name") ?? $student->segundo_nombre ?>" placeholder="Ingrese el segundo nombre " style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <small class="text-danger"><?= session("errors.second_name") ?></small>

                  </div>

                </div>

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Primer Apellido:</label>
                    <input class="form-control mt-1 " type="text" name="first_lastname" value="<?= old("first_lastname") ?? $student->primer_apellido ?>" placeholder="Ingrese el Primer Apellido" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.first_lastname") ?></small>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Segundo Apellido: <small class="text-secondary">(Opcional)</small></label>
                    <input class="form-control mt-1 " type="text" name="second_lastname" value="<?= old("second_lastname") ?? $student->segundo_apellido ?>" placeholder="Ingrese el segundo apellido" style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <small class="text-danger"><?= session("errors.second_lastname") ?></small>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6  mb-4">
                    <label class="label req fs-6">Tipo de Documento:</label>
                    <select name="id_doc_type" class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <option selected disabled hidden value="">Selecciona tipo de documento</option>
                      <?php foreach ($documentTypes as $type) : ?>
                        <option value="<?= $type->id_dparam ?>" <?php if ($type->id_dparam == $student->tipo_documento) : ?> selected <?php endif ?>><?= $type->nombre ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.id_doc_type") ?></small>

                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Estado Civil:</label>
                    <select name="id_civil" class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <option selected disabled hidden value="">Selecciona el estado civil</option>
                      <?php foreach ($civilStatus as $civil) : ?>
                        <option value="<?= $civil->id_dparam ?>" <?php if ($civil->id_dparam == $student->estado_civil) : ?> selected <?php endif ?>><?= $civil->nombre ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.id_civil") ?></small>

                  </div>


                </div>

                <div class="row">
                 

                  <div class="col-md-6  mb-4">
                    <label class="label req fs-6">Genero:</label>
                    <select name="id_genre" class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <option selected disabled hidden value="">Selecciona el genero</option>
                      <?php foreach ($genres as $genre) : ?>
                        <option value="<?= $genre->id_dparam ?>" <?php if ($genre->id_dparam == $student->sexo) : ?> selected <?php endif ?>><?= $genre->nombre ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.id_genre") ?></small>

                  </div>

                  <div class="col-md-6  mb-4">
                    <label class="label req fs-6">Programa:</label>
                    <select name="id_program" class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <option selected disabled hidden value="">Selecciona el programa</option>
                      <?php foreach ($programs as $program) : ?>
                        <option value="<?= $program->id_programa ?>" <?php if ($program->id_programa == $student->id_programa) : ?> selected <?php endif ?>>
                          <?= $program->nombre ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.id_program") ?></small>

                  </div>


                </div>

                <div class="row">


                <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Correo Electrónico:</label>
                    <input class="form-control mt-1 " type="email" name="email" value="<?= old("email") ?? $student->correo ?>" placeholder="Ingrese el correo electrónico" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Ingresa un correo válido</div>
                    <small class="text-danger"><?= session("errors.email") ?></small>

                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Teléfono:</label>
                    <input class="form-control mt-1 " type="text" name="phone" value="<?= old("phone") ?? $student->telefono ?>" placeholder="Ingrese el numero de telefono" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.phone") ?></small>

                  </div>

                </div>


                <div class="row">

                

                  <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Dirección de residencia:</label>
                    <input class="form-control mt-1 " type="text" name="address" value="<?= old("address") ?? $student->direccion ?>" placeholder="Ingrese la dirección de residencia" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.address") ?></small>

                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Estado:</label>
                    <select name="state" class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <?php if (service("request")->uri->getPath() == "estudiantes/agregar") : ?>
                        <option value="1">Activo</option>
                      <?php else : ?>
                        <option value="1" <?php if ($student->activo == "1") : ?> selected <?php endif ?>>Activo</option>
                        <option value="2" <?php if ($student->activo == "2") : ?> selected <?php endif ?>>Inactivo</option>
                      <?php endif ?>
                    </select>
                    <div class="invalid-feedback">Por favor elije un estado</div>
                    <small class=" help text-danger"><?= session("errors.state") ?></small>
                  </div>

                </div>



                <div class="form-button mt-3 d-flex justify-content-center">
                  <button id="submit" type="submit" class="btn m-2 px-4" style="color: white; background-color: <?= config("G3stor")->secondColor ?>">Guardar</button>
                  <a href="<?= base_url(route_to("students")) ?>" class="btn m-2 px-4  btn-secondary">Cancelar</a>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<?= $this->endSection() ?>