<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Realizar un prestamo
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url(route_to("lend")) ?>">Prestamos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Realizar</li>
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
              <h3 class="mb-4 fw-normal">Realizar un prestamo</h3>


              <form class="requires-validation" novalidate action="<?= base_url(route_to("lend_store")) ?>" method="POST">

                <div class="row  p-2">
                  <div class="col-md-12 mb-4">
                    <label class="label fs-6">Estudiante:</label>
                    <select name="id_student" class=" form-select mt-1" required style="background-color: <?= config("G3stor")->bodyColor ?>;" data-live-search="true">
                      <?php foreach ($students as $student) : ?>
                        <option value="<?= $student->id_estudiante ?>" <?php if (old("id_student") == $student->id_estudiante) : ?> selected <?php endif ?>>
                          <?= $student->documento ?> -
                          <?= $student->primer_nombre ?>
                          <?= $student->segundo_nombre ?>
                          <?= $student->primer_apellido ?>
                          <?= $student->segundo_apellido ?> - 
                          <?= $student->programa ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class=" help text-danger"><?= session("errors.id_editorial") ?></small>
                  </div>

                  <div class="col-md-12 mb-4 show-info">
                    <label class="label fs-6">Libro:</label>
                    <select name="id_book" class=" form-select mt-1" required style="background-color: <?= config("G3stor")->bodyColor ?>;">
                      <?php foreach ($books as $book) : ?>
                        <option value="<?= $book->id_libros ?>" <?php if (old("id_book") == $book->id_editorial) : ?> selected <?php endif ?>>
                          <?= $book->isbn ?> - <?= $book->nombre ?> 
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class=" help text-danger"><?= session("errors.id_editorial") ?></small>
                  </div>
                </div>



                <div class="form-button mt-3 d-flex justify-content-center">
                  <button id="submit" type="submit" class="btn m-2 px-4" style="color: white; background-color: <?= config("G3stor")->secondColor ?>">Guardar</button>
                  <a href="<?= base_url(route_to("lend")) ?>" class="btn m-2 px-4  btn-secondary">Cancelar</a>
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