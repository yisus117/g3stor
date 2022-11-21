  <?= $this->extend('front/layout/main') ?>

  <?= $this->section('title') ?>
  Inicio
  <?= $this->endSection() ?>


  <?= $this->section('content') ?>
  <?= $this->section('breadCrumb') ?>
  <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Inicio</li>
    </ol>
  </nav>
  <?= $this->endSection() ?>


  <section class="section  min-vh-100">

    <div class="container-fluid ">


      <div class="col main pt-1 mt-1">

        <div class="row mb-2">

          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("books")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume  shadow-lg position-relative" style="background-color: <?= config("G3stor")->secondColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->mainColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-book-open fa-3x"></i>
                  <h6 class="text-uppercase ">Libros</h6>
                </div>
                <h1 class="fs-2 fw-normal me-3 position-absolute bottom-0 end-0">
                  <?= $countBooks ?>
                </h1>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("editorials")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" " style=" background-color: <?= config("G3stor")->secondColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->mainColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute"src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-building-columns fa-3x"></i>
                  <h6 class="text-uppercase ">Editoriales</h6>
                </div>
                <h1 class="fs-2 fw-normal me-3 position-absolute bottom-0 end-0"><?= $countEditorials ?></h1>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("autors")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" " style=" background-color: <?= config("G3stor")->secondColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->mainColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-user-tie fa-3x"></i>
                  <h6 class="text-uppercase ">Autores</h6>
                </div>
                <h1 class="fs-2 fw-normal me-3 position-absolute bottom-0 end-0"><?= $countAutors ?></h1>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("book")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" " style=" background-color: <?= config("G3stor")->secondColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->mainColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-users-line fa-3x"></i>
                  <h6 class="text-uppercase ">Estudiantes</h6>
                </div>
                <h1 class="fs-2 fw-normal me-3 position-absolute bottom-0 end-0">503</h1>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("book")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" " style=" background-color: <?= config("G3stor")->secondColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->mainColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-ban fa-3x"></i>
                  <h6 class="text-uppercase ">Sanciones</h6>
                </div>
                <h1 class="fs-2 fw-normal me-3 position-absolute bottom-0 end-0">20</h1>
              </div>
            </a>
          </div>



          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("categories")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" " style=" background-color: <?= config("G3stor")->secondColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->mainColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-list fa-3x"></i>
                  <h6 class="text-uppercase ">Categorias</h6>
                </div>
                <h1 class="fs-2 fw-normal me-3 position-absolute bottom-0 end-0">15</h1>
              </div>
            </a>
          </div>





          <!-- <hr class="border border-danger border-2 opacity-50"> -->

        </div>
      </div>

    </div>
  </section>


  <?= $this->endSection() ?>