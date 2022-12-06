<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Agregar una editorial
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url(route_to("books")) ?>">Libros</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url(route_to("editorials")) ?>">Editoriales</a></li>
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
              <h3 class="mb-4 fw-normal">Agregar una editorial</h3>

              <form class="requires-validation" novalidate action="<?= base_url(route_to("editorials_store")) ?>" method="POST">

                <div class="col-md-12 mb-4">
                  <label class="label fs-6">Nombre:</label>
                  <input class="form-control mt-1 " type="text" name="name" placeholder="Ingrese el nombre" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                  <div class="valid-feedback">valido</div>
                  <div class="invalid-feedback">El campo de nombre no puede estar en blanco</div>
                </div>

                <div class="col-md-12  mb-4 mt-3">
                  <label class="label fs-6">Pais:</label>
                  <select name="id_country" class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <option selected disabled hidden value="">Selecciona un pais</option>
                    <?php foreach ($countries as $country) : ?>
                      <option value="<?= old("id_country") ?? $country->id_pais ?>" <?php if ($country->id_pais == old("id_country")) : ?> selected <?php endif ?>><?= $country->nombre ?></option>
                    <?php endforeach; ?>
                  </select>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">Por favor selecciona un pais</div>
                </div>

                <div class="col-md-12 mb-4 d-none">
                  <label class="label fs-6">Estado:</label>
                  <select class="form-select mt-1" required>
                    <?php if (service("request")->uri->getPath() == "libros/editoriales/agregar") : ?>
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
                  <a href="<?= base_url(route_to("editorials")) ?>" class="btn m-2 px-4  btn-secondary">Cancelar</a>
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



