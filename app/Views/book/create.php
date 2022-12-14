<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Agregar un libro
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url(route_to("books")) ?>">Libros</a></li>
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
              <h3 class="mb-4 fw-normal">Agregar un libro</h3>

              <form class="requires-validation" novalidate action="<?= base_url(route_to("books_store")) ?>" method="POST">
                <div class="row">

                  <div class="col-md-6 mb-4">

                    <label class="label fs-6">ISBN: <span class="fw-bold" title="Es un código de identificación único que se asigna a cada libro publicado y se utiliza para facilitar la identificación">(?)</span></label>
                    <input class="form-control mt-1 " type="text" name="isbn" value="<?= old("isbn") ?>" placeholder="Ingrese el ISBN" required style="background-color: <?= config("G3stor")->secondColor ?>;" >

                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.isbn") ?></small>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Nombre:</label>
                    <input class="form-control mt-1 " type="text" name="name"  value="<?= old("name") ?>" placeholder="Ingrese el nombre" required style="background-color: <?= config("G3stor")->secondColor ?>;">

                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.name") ?></small>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6  mb-4">
                    <label class="label fs-6">Editorial:</label>
                    <select name="id_editorial" class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <option selected disabled hidden value="">Selecciona una editorial</option>
                      <?php foreach ($editorials as $editorial) : ?>
                        <option value="<?= old("id_editorial") ?? $editorial->id_editorial ?>" <?php if ($editorial->id_editorial == old("id_editorial")) : ?> selected <?php endif ?>><?= $editorial->Nombre ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.id_editorial") ?></small>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Edicion:</label>
                    <input class="form-control mt-1 " type="text" name="edition" value="<?= old("edition") ?>" placeholder="Ingrese la edicion" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.edition") ?></small>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">N° de Paginas:</label>
                    <input class="form-control mt-1 " type="text" name="pages" value="<?= old("pages") ?>" placeholder="Ingrese el numero de paginas" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.pages") ?></small>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Costo:</label>
                    <input class="form-control mt-1 " type="text" name="cost" value="<?= old("cost") ?>" placeholder="Ingrese el costo" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.cost") ?></small>
                  </div>
                  
                </div>

                <div class="col-md-12 mb-4 d-none">
                  <label class="label fs-6">Estado:</label>
                  <select class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <?php if (service("request")->uri->getPath() == "libros/agregar") : ?>
                      <option value="1">Activo</option>
                    <?php else : ?>
                      <option selected disabled value="">Selecciona el estado</option>
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    <?php endif ?>
                  </select>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">Por favor Selecciona un estado</div>
                </div>

                <div class="form-button mt-3 d-flex justify-content-center">
                  <button id="submit" type="submit" class="btn m-2 px-4" style="color: white; background-color: <?= config("G3stor")->secondColor ?>">Guardar</button>
                  <a href="<?= base_url(route_to("books")) ?>" class="btn m-2 px-4  btn-secondary">Cancelar</a>
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




<?= $this->section('js') ?>
<script>
  (function() {
    'use strict'
    const forms = document.querySelectorAll('.requires-validation')
    Array.from(forms)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()
</script>
<?= $this->endSection() ?>