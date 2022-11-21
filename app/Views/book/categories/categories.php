<?= $this->extend('front/layout/main') ?>

<?= $this->section('title') ?>
Categorias
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->section('breadCrumb') ?>
    <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" >
      <ol class="breadcrumb">
        <li class="breadcrumb-item  text-info"><a href="<?= base_url(route_to("home")) ?>">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url(route_to("book")) ?>">Libros</a></li>
        <li class="breadcrumb-item active" aria-current="page">Categorias</li>
      </ol>
    </nav>
    <?= $this->endSection() ?>

<section class="section min-vh-100">

<div class="container-fluid">

<div class="d-flex justify-content-start align-items-center mt-2 ms-1 gap-4">
  <a href="<?= base_url(route_to("categories"))  ?>" class="btn btn-primary  px-4 fs-6" data-toggle="modal">
    <span>Categorias</span>
  </a>
  <a href="#" class="btn btn-primary px-4 fs-6" data-toggle="modal">
    <span>Editoriales</span>
  </a>
  <a href="#" class="btn btn-primary px-4 fs-6" data-toggle="modal">
    <span>Autores</span>
  </a>
</div>


<!-- table -->
<div class="table-wrapper m-1">
  <div class="table-title" style="background-color: <?= config("G3stor")->mainColor ?>">
    <div class="row">
      <div class="col-sm-6">
        <h2 class="title">Categorias</h2>
      </div>
      <div class="col-sm-6">
        <a href="<?= base_url(route_to("b_add")) ?>" class="btn btn-primary p-2 px-3 btn-lg fs-6">
          <span>Agregar una categoria</span>
        </a>
      </div>

    </div>
  </div>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>id</th>
        <th>nombre</th>
        <th>creado</th>
        <th>actualizado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Tecnologia</td>
        <td>React JS</td>
        <td>12-12-2021 12:23:56</td>
        <td>12-12-2021 12:23:56</td>
        <td class="d-flex f-row gap-2">
          <a href="<?= base_url(route_to("book_edit")) ?>" class="btn btn-secondary text-white">
            <i class="fa-solid fa-edit fs-6"></i>
          </a>
          <a href="<?= base_url(route_to("book_delete")) ?>" class="btn btn-danger text-white ">
            <i class="fa-solid fa-trash fs-6"></i>
          </a>


        </td>
      </tr>

    </tbody>
  </table>
  <div class="clearfix">
    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
    <ul class="pagination">
      <li class="page-item disabled"><a href="#">Previous</a></li>
      <li class="page-item"><a href="#" class="page-link">1</a></li>
      <li class="page-item"><a href="#" class="page-link">2</a></li>
      <li class="page-item active"><a href="#" class="page-link">3</a></li>
      <li class="page-item"><a href="#" class="page-link">4</a></li>
      <li class="page-item"><a href="#" class="page-link">5</a></li>
      <li class="page-item"><a href="#" class="page-link">Next</a></li>
    </ul>
  </div>

</div>


</div>

</section>


<?= $this->endSection() ?>