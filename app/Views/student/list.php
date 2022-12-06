<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
student
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item active">Estudiantes</li>
  </ol>
</nav>
<?= $this->endSection() ?>

<section class="section min-vh-100 mt-3">
  <div class="container-fluid">
    <div class="container-fluid ">

      <!-- table -->
      <div class="table-wrapper m-1 card" style="border: 3px solid <?= config("G3stor")->mainColor ?>">

        <div class="table-title gap-4" style="outline: 3px solid <?= config("G3stor")->mainColor ?> ;background-color: <?= config("G3stor")->secondColor ?>">


          <div class="row">
            <div class="col-6  d-flex align-items-center justify-content-between">
            <a href="<?= base_url(route_to("students")) ?>" class="title-hover no_wrap d-inline h3 text-sm-center text-md-start text-white">
              Estudiantes
              <i class="fa-solid fa-arrows-rotate fs-5 text-secondary"></i>
            </a>
            </div>

            <div class="col-6  ">
              <a href="<?= base_url(route_to("students_create")) ?>" class="btn btn-secondary p-2 px-3 mt-1 d-flex align-items-center gap-2 " style="color: white; background-color: <?= config("G3stor")->mainColor ?>">
                <i class="fa-solid fa-plus"></i>
                <span class="fs-6">Agregar</span>
              </a>
            </div>
          </div>

          <div class="row justify-content-center align-items-center g-2 rounded mt-1" style="background: <?= config("G3stor")->mainColor ?>">

            <div class="col-lg-10 p-1 mx-auto">
              <form method="GET">
                <div class="search row d-flex justify-content-center align-items-center">
                  <div class="col-6 col-md-3 col-lg-4">
                    <select name="field" class="form-select border-0 fw-semibold " required style="background-color: <?= config("G3stor")->grayColor ?>; color: <?= config("G3stor")->textColor ?>;">
                      <option selected hidden value="primer_nombre">Primer nombre</option>
                      <?php foreach ($fields  as $field) : ?>
                        <option <?= service("request")->uri->getQuery(['only' => ['field']]) == "field=" . $field ? "selected" : ""  ?> value="<?= $field ?>"><?= ucfirst(str_replace("_", " ", $field)) ?></option>
                      <?php endforeach; ?>

                    </select>
                  </div>

                  <div class="col-2 col-md-2">
                    <div class=" d-flex flex-column justify-content-center align-items-center">
                      <div class="d-flex">
                        <div class="active-group d-flex flex-column ms-2 ">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" name="active" id="active" <?= service("request")->uri->getQuery(['only' => ['active']]) !== "active=2" ? "checked" : ""  ?> />
                            <label class="form-check-label" for="active">Activos</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="2" name="active" id="inactive" <?= service("request")->uri->getQuery(['only' => ['active']]) == "active=2" ? "checked" : ""  ?> />
                            <label class="form-check-label" for="inactive">Inactivos</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-8 col-md-6">
                    <div class="d-flex">
                      <input name="q" value="<?= $query ?? '' ?>" type="text" class="form-control fw-semibold" placeholder="Buscar estudiante" style="background-color: <?= config("G3stor")->grayColor ?>; color: <?= config("G3stor")->textColor ?>;">
                      <button class="btn d-flex align-items-center justify-content-center" style="background: <?= config("G3stor")->secondColor ?>">
                        <i class="fa-solid fa-magnifying-glass fs-6"></i>
                      </button>
                    </div>
                  </div>

                </div>
              </form>
            </div>

          </div>

          <div class="row mt-1">
            <div class="d-flex justify-content-start">
              <span class=""><strong class="me-1"> Buscar: </strong><?= !$query ? 'Todos,' : '"' . $query . '",' ?> <strong class="ms-2 me-1"> En:</strong> </span>
              <?php if (service("request")->uri->getQuery(['only' => ['active']]) !== "active=2") : ?>
                <span class="card d-inline bg-success px-2 py-0 fw-normal">
                  Activos
                </span>
              <?php else : ?>
                <span class="card d-inline bg-warning px-2 py-0 fw-normal">
                  Inactivos
                </span>
              <?php endif ?>
              <span class="ms-3">
                <?= $query ? $countStudents . " Coincidencias" : "" ?>
              </span>
            </div>
          </div>

        </div>

        <?php if (!$students && !$query) : ?>
          <p class="mt-3 display-2 text-center" style="color: <?= config("G3stor")->mainColor ?>;">
            <i class="fa-regular fa-face-frown-open"></i>
          </p>
          <h3 class="mb-5 text-center" style="color: <?= config("G3stor")->mainColor ?>;">Sin registros</h3>
        <?php elseif (!$query == "" && $countStudents == 0) : ?>
          <p class="mt-3 display-2 text-center" style="color: <?= config("G3stor")->mainColor ?>;">
            <i class="fa-regular fa-face-frown-open"></i>
          </p>
          <h3 class="mb-5 text-center" style="color: <?= config("G3stor")->mainColor ?>;">Sin registros para: "<?= $query ?>" <br/> en el campo: "<?=  str_replace("field=", "",(str_replace("_", " ", service("request")->uri->getQuery(['only' => ['field']])))) ?>"</h3>

        <?php else : ?>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Documento</th>
                <th>Direccion</th>
                <th>E. Civil</th>
                <th>Sexo</th>
                <th>Correo</th>
                <th>Programa</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($students as $student) : ?>
                <tr>
                  <td><?= $student->primer_nombre ?> <?= $student->segundo_nombre ?></td>
                  <td><?= $student->primer_apellido ?> <?= $student->segundo_apellido ?></td>
                  <td><span class="more_info" title="<?= $student->tipo_documento ?>"><?= $student->tipo_documento_abv ?></span> <?= $student->documento ?></td>
                  <td><?= $student->direccion ?></td>
                  <td><span class="more_info" title="<?= $student->estado_civil ?>"><?= $student->estado_civil_abv ?></span></td>
                  <td><span class="more_info" title="<?= $student->sexo ?>"><?= $student->sexo_abv ?></td>
                  <td><?= $student->correo ?></td>
                  <td><?= $student->programa ?></td>
                  <td>
                    <span class=" px-2 py-1 fw-bold  <?= $student->activo == "1" ? "bg-success text-white text-nowrap" : ($student->activo === "2" ? "bg-warning text-dark text-nowrap" : "bg-danger") ?>">
                      <?= $student->activo == "1" ? "Activo" : ($student->activo === "2" ? "Inactivo" : "eliminado") ?>
                    </span>
                  </td>
                  <td class="d-flex f-row gap-2 mx-0">
                    <a href="<?= $student->getEditLine($student->id_estudiante) ?>" class="btn btn-secondary text-white px-2 py-1 h-4 d-flex justify-content-center align-items-center">
                      <i class="fa-solid fa-edit fs-6"></i>
                    </a>
                    <a href="<?= $student->getDeleteLine($student->id_estudiante) ?>" class="btn btn-danger text-white px-2 py-1">
                      <i class="fa-solid fa-trash fs-6"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        <?php endif ?>

        <div>
          <div class="table-footer px-2">
            <?= $pager->links() ?>
            <div class="hint-cant text-secondary">
              <?php if ($countStudents == 0) : ?>
                Sin registros
              <?php elseif ($countStudents == 1) : ?>
                <?= $countStudents ?> registro
              <?php else : ?>
                <?= $countStudents ?> registros

              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>


<?= $this->endSection() ?>