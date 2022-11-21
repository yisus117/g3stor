<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Autores
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item "><a href="<?= base_url(route_to("books")) ?>">Libros</a></li>
    <li class="breadcrumb-item active">Autores</li>
  </ol>
</nav>
<?= $this->endSection() ?>

<section class="section min-vh-100">
  <div class="container-fluid">
    <div class="container-fluid ">

      <!-- table -->
      <div class="table-wrapper m-1 card" style="border: 3px solid <?= config("G3stor")->mainColor ?>">

        <div class="table-title" style="outline: 3px solid <?= config("G3stor")->mainColor ?> ;background-color: <?= config("G3stor")->mainColor ?>">
          <div class="row d-flex flex-row gap-4 gap-md-0 position-relative">
            <div class="col-sm-12 col-md-3 d-flex align-items-center">
              <a href="<?= base_url(route_to("autors")) ?>" class="d-inline h3 text-sm-center text-md-start text-white">Autores</a>
            </div>
            <div class="col-sm-12 col-md-6 p-2 rounded" style="background: <?= config("G3stor")->secondColor ?>">
              <form action="" method="GET" class="search">
                <input name="q" value="<?= $query ?? '' ?>" type="text" class="form-control" placeholder="Buscar un autor">
                <div class="d-flex justify-content-center align-items-center">

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
                  <button class="btn d-flex align-items-center justify-content-center" style="background: <?= config("G3stor")->mainColor ?>">
                    <i class="fa-solid fa-magnifying-glass fs-6"></i>

                  </button>
                </div>
              </form>

              <span class=" pt-4"><strong class="me-1"> Buscar: </strong><?= !$query ? 'Todos,' : '"' . $query . '",' ?> <strong class="ms-2 me-1"> En:</strong> </span>
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
                <?= $query ? $countAutors . " Coincidencias" : "" ?>
              </span>
            </div>
            <div class="col-sm-12 col-md-3 position-absolute top-0 end-0 ">
              <a href="<?= base_url(route_to("autors_create")) ?>" class="btn btn-secondary p-2 px-3 mt-1 d-flex align-items-center gap-2 " style="color: white; background-color: <?= config("G3stor")->secondColor ?>">
                <i class="fa-solid fa-plus"></i>
                <span class="fs-6">Agregar</span>
              </a>
            </div>
          </div>
        </div>

        <?php if (!$autors && !$query) : ?>
          <p class="mt-3 display-2 text-center" style="color: <?= config("G3stor")->mainColor ?>;">
            <i class="fa-regular fa-face-frown-open"></i>
          </p>
          <h3 class="mb-5 text-center" style="color: <?= config("G3stor")->mainColor ?>;">Sin registros</h3>
        <?php elseif (!$query == "" && $countAutors == 0) : ?>
          <p class="mt-3 display-2 text-center" style="color: <?= config("G3stor")->mainColor ?>;">
            <i class="fa-regular fa-face-frown-open"></i>
          </p>
          <h3 class="mb-5 text-center" style="color: <?= config("G3stor")->mainColor ?>;">Sin registros para: "<?= $query ?>"</h3>

        <?php else : ?>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Seudonimo</th>
                <th>dirección</th>
                <th>pais</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($autors as $autor) : ?>
                <tr>
                  <td><?= $autor->primer_nombre ?> <?= $autor->segundo_nombre ?></td>
                  <td><?= $autor->primer_apellido ?> <?= $autor->segundo_apellido ?></td>
                  <td><?= $autor->seudonimo ?></td>
                  <td><?= $autor->direccion ?></td>
                  <td><?= $autor->pais ?></td>
                  <td>
                    <span class=" px-2 py-1 fw-bold  <?= $autor->estado == "1" ? "bg-success text-white text-nowrap" :  ($autor->estado === "2" ? "bg-warning text-dark text-nowrap" : "bg-danger") ?>">
                      <?= $autor->estado == "1" ? "Activo" :  ($autor->estado === "2" ? "Inactivo" : "eliminado") ?>
                    </span>
                  </td>
                  <td class="d-flex f-row gap-2 mx-0">
                    <a href="<?= $autor->getEditLine($autor->id_autor) ?>" class="btn btn-secondary text-white px-2 py-1 h-4 d-flex justify-content-center align-items-center">
                      <i class="fa-solid fa-edit fs-6"></i>
                    </a>
                    <a href="<?= $autor->getDeleteLine($autor->id_autor) ?>" class="btn btn-danger text-white px-2 py-1">
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
              <?php if ($countAutors == 0) : ?>
                Sin registros
              <?php elseif ($countAutors == 1) : ?>
                <?= $countAutors ?> registro
              <?php else : ?>
                <?= $countAutors ?> registros

              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>


<?= $this->endSection() ?>