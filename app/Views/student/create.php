<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Agregar un estudiante
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
              <h3 class="mb-4 fw-normal">Agregar un estudiante</h3>

              <form class="requires-validation" novalidate action="<?= base_url(route_to("autors_store")) ?>" method="POST">

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Primer Nombre:</label>
                    <input class="form-control mt-1 " type="text" name="first_name" placeholder="Ingrese el nombre" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Segundo Nombre: <small class="text-secondary">(Opcional)</small></label>
                    <input class="form-control mt-1 " type="text" name="second_name" placeholder="Ingrese el segundo nombre "  style="background-color: <?= config("G3stor")->secondColor ?>;">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Primer Apellido:</label>
                    <input class="form-control mt-1 " type="text" name="first_lastname" placeholder="Ingrese el Primer Apellido" required  style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Segundo Apellido: <small class="text-secondary">(Opcional)</small></label>
                    <input class="form-control mt-1 " type="text" name="second_lastname" placeholder="Ingrese el segundo apellido"  style="background-color: <?= config("G3stor")->secondColor ?>;">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6  mb-4">
                    <label class="label fs-6">Tipo de Documento:</label>
                    <select name="id_doc_type" class="form-select mt-1" required  style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <option selected disabled hidden value="">Selecciona el tipo de documento</option>
                      <?php foreach ($documentTypes as $type) : ?>
                        <option value="<?= old("id_country") ?? $type->id_dparam ?>" <?php if ($type->nombre == old("id_doc_type")) : ?> selected <?php endif ?>><?= $type->nombre ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6"># documento:</label>
                    <input class="form-control mt-1 " type="text" name="address" placeholder="Ingrese el # de documento" required  style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                  </div>



                </div>

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Estado Civil:</label>
                    <select name="id_civil" class="form-select mt-1" required  style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <option selected disabled hidden value="">Selecciona el estado civil</option>
                      <?php foreach ($civilStatus as $civil) : ?>
                        <option value="<?= old("id_civil") ?? $civil->id_dparam ?>" <?php if ($civil->nombre == old("id_civil")) : ?> selected <?php endif ?>><?= $civil->nombre ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                  </div>

                  <div class="col-md-6  mb-4">
                    <label class="label fs-6">Genero:</label>
                    <select name="id_genre" class="form-select mt-1" required  style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <option selected disabled hidden value="">Selecciona el genero</option>
                      <?php foreach ($genres as $genre) : ?>
                        <option value="<?= old("id_genre") ?? $genre->id_dparam ?>" <?php if ($genre->nombre == old("id_genre")) : ?> selected <?php endif ?>><?= $genre->nombre ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                  </div>


                </div>

                <div class="row">


                  <div class="col-md-6  mb-4">
                    <label class="label fs-6">Programa:</label>
                    <select name="id_program" class="form-select mt-1" required  style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <option selected disabled hidden value="">Selecciona el programa</option>
                      <?php foreach ($programs as $program) : ?>
                        <option value="<?= old("id_genre") ?? $program->id_programa ?>" <?php if ($program->nombre == old("id_program")) : ?> selected <?php endif ?>><?= $program->nombre ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Teléfono:</label>
                    <input class="form-control mt-1 " type="text" name="address" placeholder="Ingrese el numero de telefono" required  style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                  </div>

                </div>


                <div class="row">

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Correo Electrónico:</label>
                    <input class="form-control mt-1 " type="email" name="address" placeholder="Ingrese el correo electrónico" required  style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Ingresa un correo válido</div>
                  </div>


                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Dirección de residencia:</label>
                    <input class="form-control mt-1 " type="text" name="address" placeholder="Ingrese la dirección de residencia" required  style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                  </div>




                </div>


                <div class="col-md-12 mb-4 d-none">
                  <label class="label fs-6">Estado:</label>
                  <select class="form-select mt-1" required>
                    <?php if (service("request")->uri->getPath() == "libros/autores/agregar") : ?>
                      <option value="1">Activo</option>
                    <?php else : ?>
                      <option selected disabled></option>
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    <?php endif ?>
                  </select>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">Este campo es obligatorio</div>
                </div>

                <div class="form-button mt-3 d-flex justify-content-center">
                  <button id="submit" type="submit" class="btn m-2 px-4" style="color: white; background-color: <?= config("G3stor")->secondColor ?>">Guardar</button>
                  <a href="<?= base_url(route_to("autors")) ?>" class="btn m-2 px-4  btn-secondary">Cancelar</a>
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