<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Agregar un usuario
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url(route_to("users")) ?>">Usuarios</a></li>
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
              <h3 class="mb-4 fw-normal">Agregar un usuario</h3>

              <form class="requires-validation" novalidate action="<?= base_url(route_to("users_store")) ?>" method="POST">

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Primer Nombre:</label>
                    <input class="form-control mt-1 " type="text" name="first_name" value="<?= old("first_name") ?>" placeholder="Ingrese el nombre" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.first_name") ?></small>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label  fs-6">Segundo Nombre: <small class="text-secondary">(Opcional)</small></label>
                    <input class="form-control mt-1 " type="text" name="second_name" value="<?= old("second_name") ?>" placeholder="Ingrese el segundo nombre " style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <small class="text-danger"><?= session("errors.second_name") ?></small>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Primer Apellido:</label>
                    <input class="form-control mt-1 " type="text" name="first_lastname" value="<?= old("first_name") ?>" placeholder="Ingrese el Primer Apellido" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.first_lastname") ?></small>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label fs-6">Segundo Apellido: <small class="text-secondary">(Opcional)</small></label>
                    <input class="form-control mt-1 " type="text" name="second_lastname" value="<?= old("second_lastname") ?>" placeholder="Ingrese el segundo apellido" style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <small class="text-danger"><?= session("errors.second_lastname") ?></small>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Correo:</label>
                    <input class="form-control mt-1 " type="text" name="email" value="<?= old("email") ?>" placeholder="Ingrese el correo" style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.email") ?></small>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Rol:</label>
                    <select name="role" class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                      <option selected disabled hidden value="">Selecciona un grupo</option>
                      <?php foreach ($groups as $group) : ?>
                        <option style="text-transform: uppercase; fw-bold" class="text-uppercase" value="<?= $group->id_grupo ?>" <?php if ($group->id_grupo == old("role")) : ?> selected <?php endif ?>><?= strtoupper($group->nombre_grupo) ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.role") ?></small>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Contraseña:</label>
                    <input class="form-control mt-1 " type="text" name="password" placeholder="Ingrese el Primer Apellido" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.password") ?></small>
                  </div>

                  <div class="col-md-6 mb-4">
                    <label class="label req fs-6">Repetir contraseña:</label>
                    <input class="form-control mt-1 " type="text" name="rep_password" placeholder="Ingrese el Primer Apellido" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="invalid-feedback">Este campo es obligatorio</div>
                    <small class="text-danger"><?= session("errors.rep_password") ?></small>
                  </div>

                </div>


                <div class="col-md-12 mb-4 d-none">
                  <label class="label fs-6">Estado:</label>
                  <select class="form-select mt-1" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <?php if (service("request")->uri->getPath() == "usuarios/agregar") : ?>
                      <option value="1">Activo</option>
                    <?php else : ?>
                      <option selected disabled value="">Selecciona el estado</option>
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    <?php endif ?>
                  </select>
                  <div class="valid-feedback"></div>
                </div>

                <div class="form-button mt-3 d-flex justify-content-center">
                  <button id="submit" type="submit" class="btn m-2 px-4" style="color: white; background-color: <?= config("G3stor")->secondColor ?>">Guardar</button>
                  <a href="<?= base_url(route_to("users")) ?>" class="btn m-2 px-4  btn-secondary">Cancelar</a>
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