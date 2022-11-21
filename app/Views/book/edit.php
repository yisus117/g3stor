<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Editar Libro: <?= $book->nombre ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url(route_to("book")) ?>">Libros</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
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
              <h3 class="mb-4 fw-normal">Editar libro: "<?= $book->nombre ?>"</h3>

              <form class="requires-validation" novalidate action="<?= base_url(route_to("book_update")) ?>" method="POST">

                <input type="hidden" class="form-control mt-1 " type="text" name="id_book" value="<?= $book->id_libros ?>" required>

                <div class="col-md-12 mb-4">
                  <label class="label fs-6">Nombre:</label>
                  <input class="form-control mt-1 " type="text" name="name" value="<?= old("name") ?? $book->nombre ?>" placeholder="Ingrese el nombre" required>
                  <div class="invalid-feedback">El campo de nombre no puede estar en blanco</div>
                  <small class=" help text-danger"><?= session("errors.name") ?></small>
                </div>

                <div class="col-md-12 mb-4 mt-3">
                  <label class="label fs-6">Editorial:</label>
                  <select name="id_editorial" value="" class="form-select mt-1" required>
                    <?php foreach ($editorials as $editorial) : ?>
                      <option value="<?= $editorial->id_editorial ?>" <?php if ($editorial->id_editorial == $book->id_editorial) : ?> selected <?php endif ?>  >
                        <?= $editorial->nombre ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback">Por favor selecciona un pais</div>
                  <small class=" help text-danger"><?= session("errors.id_editorial") ?></small>
                </div>

                <div class="col-md-12 mb-4">
                  <label class="label fs-6">Edicion:</label>
                  <input class="form-control mt-1 " type="text" name="edition" value="<?= old("edition") ?? $book->edicion ?>" placeholder="Ingrese la edicion" required>
                  <div class="invalid-feedback">El campo de edition no puede estar en blanco</div>
                  <small class=" help text-danger"><?= session("errors.edition") ?></small>
                </div>

                <div class="col-md-12 mb-4">
                  <label class="label fs-6">N° de paginas:</label>
                  <input class="form-control mt-1 " type="text" name="pages" value="<?= old("pages") ?? $book->paginas ?>" placeholder="Ingrese el numero de paginas" required>
                  <div class="invalid-feedback">El campo de pages no puede estar en blanco</div>
                  <small class=" help text-danger"><?= session("errors.pages") ?></small>
                </div>



                <div class="col-md-12 mb-4 mt-3">
                  <label class="label fs-6">Estado:</label>
                  <select name="state" class="form-select mt-1" required >
                    <?php if (service("request")->uri->getPath() == "libros/crear") : ?>
                      <option value="1">Activo</option>
                    <?php else : ?>
                      <option value="1" <?php if ($book->activo == "1") : ?> selected <?php endif ?>>Activo</option>
                      <option value="2"  <?php if ($book->activo == "2") : ?> selected <?php endif ?>>Inactivo</option>
                    <?php endif ?>
                  </select>
                  <div class="invalid-feedback">Por favor elije un estado</div>
                  <small class=" help text-danger"><?= session("errors.state") ?></small>
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


