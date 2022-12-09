<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Editar autor: <?= $autor->nombre ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url(route_to("books")) ?>">Libros</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url(route_to("autors")) ?>">Autores</a></li>
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
              <h3 class="mb-4 fw-normal">Editar autor: "<?= $autor->primer_nombre ?> <?= $autor->primer_apellido ?>"</h3>

              <form class="requires-validation" novalidate action="<?= base_url(route_to("autors_update")) ?>" method="POST">

                <div class="row">
                  <div class="col-md-2 mb-4">
                    <label class="label fs-6">ID:</label>
                    <input readonly class="form-control mt-1 " type="text" name="id_autor" value="<?= $autor->id_autor ?>" required>
                  </div>
                  </div>
                  <div class="row">

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Primer Nombre:</label>
                    <input class="form-control mt-1 " type="text" name="first_name" value="<?= old("first_name") ?? $autor->primer_nombre ?>" placeholder="Ingrese el nombre" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.first_name") ?></small>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Segundo Nombre: <small class="text-secondary">(Opcional)</small></label>
                    <input class="form-control mt-1 " type="text" name="second_name" value="<?= old("second_name") ?? $autor->segundo_nombre ?>" placeholder="Ingrese el segundo nombre" style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <small class=" help text-danger"><?= session("errors.second_name") ?></small>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Primer Apellido:</label>
                    <input class="form-control mt-1 " type="text" name="first_lastname" value="<?= old("first_lastname") ?? $autor->primer_apellido ?>" placeholder="Ingrese el Primer Apellido" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.first_lastname") ?></small>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Segundo Apellido: <small class="text-secondary">(Opcional)</small></label>
                    <input class="form-control mt-1 " type="text" name="second_lastname" value="<?= old("second_lastname") ?? $autor->segundo_apellido ?>" placeholder="Ingrese el segundo apellido " style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <small class=" help text-danger"><?= session("errors.second_lastname") ?></small>
                  </div>
                </div>
                <div class="row">

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Seudonimo: <small class="text-secondary">(Opcional)</small></label>
                    <input class="form-control mt-1 " type="text" name="pseudonym" value="<?= old("pseudonym") ?? $autor->seudonimo ?>" placeholder="Ingrese el seudonimo " style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <small class=" help text-danger"><?= session("errors.pseudonym") ?></small>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Dirección: <small class="text-secondary">(Opcional)</small></label>
                    <input class="form-control mt-1 " type="text" name="address" value="<?= old("address") ?? $autor->direccion ?>" placeholder="Ingrese el nombre" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.address") ?></small>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6  mb-4 ">
                    <label class="label fs-6">Pais:</label>
                    <select name="id_country" value="" class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <?php foreach ($countries as $country) : ?>
                        <option value="<?= $country->id_pais ?>" <?php if ($country->id_pais == $autor->id_pais) : ?> selected <?php endif ?>>
                          <?= $country->nombre ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.id_country") ?></small>
                  </div>

                  <div class="col-md-6 mb-4 ">
                    <label class="label fs-6">Estado:</label>
                    <select name="state" class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <?php if (service("request")->uri->getPath() == "libros/autores/crear") : ?>
                        <option value="1">Activo</option>
                      <?php else : ?>
                        <option value="1" <?php if ($autor->estado == "1") : ?> selected <?php endif ?>>Activo</option>
                        <option value="2" <?php if ($autor->estado == "2") : ?> selected <?php endif ?>>Inactivo</option>
                      <?php endif ?>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.state") ?></small>

                  </div>
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