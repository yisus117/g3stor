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



              <div class="row bg-success p-2">
                <div class="col-md-6 mb-4">
                <form  method="GET">
                    <label class="label fs-6">Documento del estudiante:</label>
                    <input class="form-control mt-1" value="<?= $search ?? '' ?>" type="text" name="doc" placeholder="Ingrese el documento" required style="background-color: <?= config("G3stor")->secondColor ?>;">
                    <div class="valid-feedback">valido</div>
                    <div class="invalid-feedback">El campo de nombre no puede estar en blanco</div>
                    <div class=" mt-3 d-flex justify-content-center">
                      <button class="btn m-2 px-4" style="color: white; background-color: <?= config("G3stor")->secondColor ?>">buscar</button>
                    </form>
                  </div>
                  </div>
                <div class="col-md-6 mb-4 show-info">
                  <?php if(isset($student)): ?>
                    <input readonly class="form-control mt-1 " value="Nombre: <?= $student->primer_nombre ?> <?= $student->segundo_nombre ?>" type="text" name="doc" placeholder="Ingrese el documento" required style="background-color: <?= config("G3stor")->secondColor ?>;">

                    <input readonly class="form-control mt-1 " value="<?= $student->primer_apellido ?> <?= $student->segundo_apellido ?>" type="text" name="doc" placeholder="Ingrese el documento" required style="background-color: <?= config("G3stor")->secondColor ?>;">

                    <input readonly class="form-control mt-1 " value="<?= $student->correo ?>" type="text" name="doc" placeholder="Ingrese el documento" required style="background-color: <?= config("G3stor")->secondColor ?>;">

                    <input readonly class="form-control mt-1 " value="<?= $student->programa ?>" type="text" name="doc" placeholder="Ingrese el documento" required style="background-color: <?= config("G3stor")->secondColor ?>;">

                    <input readonly class="form-control mt-1 " value="<?= $student->activo ?>" type="text" name="doc" placeholder="Ingrese el documento" required style="background-color: <?= config("G3stor")->secondColor ?>;">

                    <?php elseif($search && !$student ): ?>
                      <h4>Sin resultados</h4>
                    <?php endif ?>
               
                </div>



              </div>
              <form class="requires-validation" novalidate action="<?= base_url(route_to("lend_create")) ?>" method="POST">

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