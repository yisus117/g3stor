<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Prestamos
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
<nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
    <li class="breadcrumb-item active">Prestamos</li>
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
            <a href="<?= base_url(route_to("lend")) ?>" class="title-hover no_wrap d-inline h3 text-sm-center text-md-start text-white">
              Prestamos
              <i class="fa-solid fa-arrows-rotate fs-5 text-secondary"></i>
            </a>
          </div>

          <div class="col-6  ">
            <a href="<?= base_url(route_to("lend_create")) ?>" class="btn btn-secondary p-2 px-3 mt-1 d-flex align-items-center gap-2 " style="color: white; background-color: <?= config("G3stor")->mainColor ?>" title="Agregar un nuevo registro">
              <i class="fa-solid fa-plus"></i>
              <span class="fs-6">Agregar</span>
            </a>
          </div>
        </div>

        <div class="row justify-content-center align-items-center g-2 rounded mt-2" style="background: <?= config("G3stor")->mainColor ?>">

          <div class="col-lg-12 p-1 mx-auto py-2 ">
            <form method="GET">
              <div class="search row d-flex justify-content-center align-items-center gap-2">
                <div class="col-6 col-md-3 m-0 pe-0">
                  <select name="field" class="form-select border-0 fw-semibold " required style="background-color: <?= config("G3stor")->grayColor ?>; color: <?= config("G3stor")->textColor ?>;">
                    <option selected hidden value="Nombre">Nombre</option>
                    <?php foreach ($fields  as $field) : ?>
                      <option <?= service("request")->uri->getQuery(['only' => ['field']]) == "field=" . $field ? "selected" : ""  ?> value="<?= $field ?>"><?= ucfirst(str_replace("_", " ", $field)) ?></option>
                    <?php endforeach; ?>

                  </select>
                </div>

                <div class="col-2 col-md-2 mt-0 ps-0">
                  <div class=" d-flex flex-column justify-content-center">
                    <div class="d-flex">
                      <div class="card check-btn d-flex flex-column ms-2 ">
                        <label for="checkbox" title="Buscar registros activos o inactivos" class="no_wrap">
                          <input type="checkbox" id="checkbox" name="activos" <?php if (service("request")->uri->getQuery(['only' => ['activos']]) == "activos=on" || !service("request")->uri->getQuery(['only' => ['q']])) :  ?> checked <?php endif ?>>
                          <span>
                            <i class="fa-solid fa-hand-pointer"></i>
                            Activos
                          </span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-8 col-md-6 m-0 p-0">
                  <div class="d-flex justify-content-around  ">
                    <input name="q" value="<?= $query ?? '' ?>" type="text" class="form-control fw-semibold" placeholder="Buscar estudiante" style="background-color: <?= config("G3stor")->grayColor ?>; color: <?= config("G3stor")->textColor ?>;">
                    <button class="btn d-flex align-items-center justify-content-center" style="background: <?= config("G3stor")->secondColor ?>" title="Buscar un registro">
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

            <?php if (service("request")->uri->getQuery(['only' => ['activos']]) == "activos=on" || !service("request")->uri->getQuery(['only' => ['q']])) : ?>
              <span class="rounded d-inline bg-success px-2 py-0 fw-normal">
                Activos
              </span>
            <?php else : ?>
              <span class="rounded d-inline bg-warning px-2 py-0 fw-normal">
                Inactivos
              </span>
            <?php endif ?>
            <span class="ms-3">
              <?= $query ? $countLend . " Coincidencias" : "" ?>
            </span>
          </div>
        </div>

      </div>

      <?php if (!$lend && !$query) : ?>
        <p class="mt-3 display-2 text-center" style="color: <?= config("G3stor")->mainColor ?>;">
          <i class="fa-regular fa-face-frown-open"></i>
        </p>
        <h3 class="mb-5 text-center" style="color: <?= config("G3stor")->mainColor ?>;">Sin registros</h3>
      <?php elseif (!$query == "" && $countLend == 0) : ?>
        <p class="mt-3 display-2 text-center" style="color: <?= config("G3stor")->mainColor ?>;">
          <i class="fa-regular fa-face-frown-open"></i>
        </p>
        <h3 class="mb-5 text-center" style="color: <?= config("G3stor")->mainColor ?>;">Sin registros para: "<?= $query ?>" <br /> en el campo: "<?= str_replace("field=", "", (str_replace("_", " ", service("request")->uri->getQuery(['only' => ['field']])))) ?>"</h3>

      <?php else : ?>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Estudiante</th>
              <th>Libro</th>
              <th>Fecha del prestamo</th>
              <th>Fecha de devoluci??n</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($lend as $item) : ?>
              <tr>
                <td><?= $item->id_prestamo ?></td>
                <td><?= $item->primer_nombre ?> <?= $item->segundo_nombre ?> <?= $item->primer_apellido ?> <?= $item->segundo_apellido ?></td>
                <td><?= $item->libro ?></td>
                <td><?= $item->fecha_prestamo ?></td>
                <td><?= $item->fecha_devolucion ?></td>
                <td>
                  
                <span class=" px-2 py-1 fw-bold  <?= $item->estado == "1" ? "bg-success text-white text-nowrap" : ($item->estado === "2" ? "bg-warning text-dark text-nowrap" : "bg-danger") ?>">
                  <?= $item->estado == "1" ? "En prestamo" : ($item->estado === "2" ? "Inactivo" : ($item->estado === "3" ? "En prestamo" : "Eliminado")) ?>
                  </span>
                </td>
                <td class="">
                  <div class="d-flex f-row gap-2 mx-0 ">
                    <!-- <a href="<?= $item->getSeeMoreLine($item->id_prestamo) ?>" name="more" class="btn btn-secondary text-white update px-2 py-1 h-4 d-flex justify-content-center align-items-center">
                      <i class="fa-solid fa-edit fs-6"></i>
                      ver mas
                      <i class="fa-solid fa-hand-pointer fs-6"></i>
                    </a> -->
                  
                    <button type="button" data-name="<?= $item->libro ?>"   data-id="<?= $item->id_libro ?>" class="btn btn-secondary delete text-white px-2 py-1">
                      Devolver
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
            <?php if ($countLend == 0) : ?>
              Sin registros
            <?php elseif ($countLend == 1) : ?>
              <?= $countLend ?> registro
            <?php else : ?>
              <?= $countLend ?> registros

            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script>
(function () {
  $(".delete").click(function (e) {
    e.preventDefault();
    var id = $(this).parents("tr").find("td:first").text();
    var name = $(this).attr("data-name");
    var libro = $(this).attr("data-id");
    ruta = location.pathname;
    console.log(id);

    $(".delete").prop("disabled", true);
    $("a").click(function (e) {
      e.preventDefault();
    });

    swal
      .fire({
        title: "Devoluci??n?",
        text: ' devolver el libro "' + name + '" ?',
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: true,
      })
      .then((isConfirmed) => {
        if (isConfirmed.value) {
          $.ajax({
            url: `${ruta}/eliminar/${id}/${libro}`,
            success: function (response) {
              location.reload();
            },
            error: function () {
              $(".delete").prop("disabled", false);
              $("a").off("click");
              swal.fire(
                "Error!",
                "Error al tratar de eliminar el registro",
                "warning"
              );
            },
          });
        } else {
          $(".delete").prop("disabled", false);
          $("a").off("click");
        }
      });
  });
})();


</script>
<?= $this->endSection() ?>