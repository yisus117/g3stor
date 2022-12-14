<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Usuarios
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item active">Usuarios</li>
  </ol>
</nav>
<?= $this->endSection() ?>

<section class="section min-vh-100 mt-3">
  <div class="container-fluid">

    <!-- table -->
    <div class="table-wrapper m-1 card" style="border: 3px solid <?= config("G3stor")->mainColor ?>">
      <div class="table-title gap-4" style="outline: 3px solid <?= config("G3stor")->mainColor ?> ;background-color: <?= config("G3stor")->secondColor ?>">
        <div class="row">
          <div class="col-6  d-flex align-items-center justify-content-between">
            <a href="<?= base_url(route_to("users")) ?>" class="title-hover no_wrap d-inline h3 text-sm-center text-md-start text-white">
              Usuarios
              <i class="fa-solid fa-arrows-rotate fs-5 text-secondary"></i>
            </a>
          </div>

          <div class="col-6  ">
            <a href="<?= base_url(route_to("users_create")) ?>" class="btn btn-secondary p-2 px-3 mt-1 d-flex align-items-center gap-2 " style="color: white; background-color: <?= config("G3stor")->mainColor ?>" title="Agregar un nuevo registro">
              <i class="fa-solid fa-plus"></i>
              <span class="fs-6">Agregar</span>
            </a>
          </div>
        </div>

      </div>

      <?php if (!$users && !$query) : ?>
        <p class="mt-3 display-2 text-center" style="color: <?= config("G3stor")->mainColor ?>;">
          <i class="fa-regular fa-face-frown-open"></i>
        </p>
        <h3 class="mb-5 text-center" style="color: <?= config("G3stor")->mainColor ?>;">Sin registros</h3>
      <?php elseif (!$query == "" && $countUsers == 0) : ?>
        <p class="mt-3 display-2 text-center" style="color: <?= config("G3stor")->mainColor ?>;">
          <i class="fa-regular fa-face-frown-open"></i>
        </p>
        <h3 class="mb-5 text-center" style="color: <?= config("G3stor")->mainColor ?>;">Sin registros para: "<?= $query ?>" <br /> en el campo: "<?= str_replace("field=", "", (str_replace("_", " ", service("request")->uri->getQuery(['only' => ['field']])))) ?>"</h3>

      <?php else : ?>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Correo</th>
              <th>Role</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($users as $user) : ?>


              <tr>
                <td><?= $user->id_usuario ?></td>
                <td><?= $user->primer_nombre ?> <?= $user->segundo_nombre ?></td>
                <td><?= $user->primer_apellido ?> <?= $user->segundo_apellido ?></td>
                <td><?= $user->correo ?> </td>
                <td><?= $user->getRole()->nombre_grupo ?> </td>
                <td>
                  <span class=" px-2 py-1 fw-bold  <?= $user->activo == "1" ? "bg-success text-white text-nowrap" : ($user->activo === "2" ? "bg-warning text-dark text-nowrap" : "bg-danger") ?>">
                    <?= $user->activo == "1" ? "Activo" : ($user->activo === "2" ? "Inactivo" : "eliminado") ?>
                  </span>
                </td>
        
                <td class="">
                  <div class="d-flex f-row gap-2 mx-0 ">
                    <a href="<?= $user->getEditLine($user->id_usuario) ?>" name="update" class="btn btn-secondary text-white update px-2 py-1 h-4 d-flex justify-content-center align-items-center">
                      <i class="fa-solid fa-edit fs-6"></i>
                    </a>
                    <button type="button" data-name="<?= $user->primer_nombre ?> <?= $user->primer_apellido ?>" class="btn btn-danger delete text-white px-2 py-1">
                      <i class="fa-solid fa-trash fs-6"></i>
                    </button>
                  </div>
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
            <?php if ($countUsers == 0) : ?>
              Sin registros
            <?php elseif ($countUsers == 1) : ?>
              <?= $countUsers ?> registro
            <?php else : ?>
              <?= $countUsers ?> registros

            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script src="<?= base_url("/js/alert.js") ?>"></script>
<?= $this->endSection() ?>