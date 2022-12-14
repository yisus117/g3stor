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
            <a href="<?= base_url(route_to("books")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume  shadow-lg position-relative" style=" background-color: <?= config("G3stor")->mainColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->secondColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-book-open fa-3x"></i>
                  <h6 class="text-uppercase mt-1">Libros</h6>
                </div>
                <h1 class="book-item-number fs-2 fw-normal me-3 position-absolute bottom-0 end-0">
                  <?= $countBooks ?>
                </h1>
              </div>
              <div class="dashboard-item-footer">
                Más info
                <i class="fa-solid fa-hand-pointer fs-6"></i>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("editorials")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" style=" background-color: <?= config("G3stor")->mainColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->secondColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-building-columns fa-3x"></i>
                  <h6 class="text-uppercase mt-1">Editoriales</h6>
                </div>
                <h1 class="book-item-number fs-2 fw-normal me-3 position-absolute bottom-0 end-0"><?= $countEditorials ?></h1>
              </div>
              <div class="dashboard-item-footer">
                Más info
                <i class="fa-solid fa-hand-pointer fs-6"></i>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("autors")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" style=" background-color: <?= config("G3stor")->mainColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->secondColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-user-tie fa-3x"></i>
                  <h6 class="text-uppercase mt-1">Autores</h6>
                </div>
                <h1 class="book-item-number fs-2 fw-normal me-3 position-absolute bottom-0 end-0"><?= $countAutors ?></h1>
              </div>
              <div class="dashboard-item-footer">
                Más info
                <i class="fa-solid fa-hand-pointer fs-6"></i>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("students")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" style=" background-color: <?= config("G3stor")->mainColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->secondColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-users-line fa-3x"></i>
                  <h6 class="text-uppercase mt-1">Estudiantes</h6>
                </div>
                <h1 class="book-item-number fs-2 fw-normal me-3 position-absolute bottom-0 end-0"><?= $countStudents ?></h1>
              </div>
              <div class="dashboard-item-footer">
                Más info
                <i class="fa-solid fa-hand-pointer fs-6"></i>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("book")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" style=" background-color: <?= config("G3stor")->mainColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->secondColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-ban fa-3x"></i>
                  <h6 class="text-uppercase mt-1">Sanciones</h6>
                </div>
                <h1 class="book-item-number fs-2 fw-normal me-3 position-absolute bottom-0 end-0">20</h1>
              </div>
              <div class="dashboard-item-footer">
                Más info
                <i class="fa-solid fa-hand-pointer fs-6"></i>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("lend")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" style=" background-color: <?= config("G3stor")->mainColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->secondColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">

                  <div class="com d-flex flex-column m-0 p-0 position-relative">
                    <i class="fa-solid fa-book fa-2x position-absolute " style="top: -7px; left:0; right:0; margin: auto;"></i>
                    <i class="fa-solid fa-hand-holding fa-3x"></i>
                  </div>

                  <h6 class="text-uppercase mt-1">Prestamos</h6>
                </div>
                <h1 class="book-item-number fs-2 fw-normal me-3 position-absolute bottom-0 end-0">20</h1>
              </div>
              <div class="dashboard-item-footer">
                Más info
                <i class="fa-solid fa-hand-pointer fs-6"></i>
              </div>
            </a>
          </div>


          <?php if (session()->get('user_role') === "master") { ?>
            <div class="col-xl-3 col-sm-6 py-2">
              <a href="<?= base_url(route_to("users")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" style=" background-color: <?= config("G3stor")->textColor ?>;">
                <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->secondColor ?>">
                  <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                  <div class="book-type " style="z-index: 30;">
                    <i class="fa-solid fa-users-gear fa-3x"></i>
                    <h6 class="text-uppercase mt-1">Usuarios</h6>
                  </div>
                  <h1 class="book-item-number fs-2 fw-normal me-3 position-absolute bottom-0 end-0">20</h1>
                </div>
                <div class="dashboard-item-footer">
                  Más info
                  <i class="fa-solid fa-hand-pointer fs-6"></i>
                </div>
              </a>
            </div>
          <?php } ?>

          <?php if (session()->get('user_role') === "master" || session()->get('user_role') === "admin") { ?>
            <div class="col-xl-3 col-sm-6 py-2">
              <a href="<?= base_url(route_to("lend")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" style=" background-color: <?= config("G3stor")->textColor ?>;">
                <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->secondColor ?>">
                  <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                  <div class="book-type " style="z-index: 30;">
                    <i class="fa-solid fa-clipboard-list fa-3x"></i>
                    <h6 class="text-uppercase mt-1">Auditoría</h6>
                  </div>
                  <h1 class="book-item-number fs-2 fw-normal me-3 position-absolute bottom-0 end-0">20</h1>
                </div>
                <div class="dashboard-item-footer">
                  Más info
                  <i class="fa-solid fa-hand-pointer fs-6"></i>
                </div>
              </a>
            </div>
          <?php } ?>
          <i class="fa-solid fa-list-ol"></i>

          <!-- 
          <div class="col-xl-3 col-sm-6 py-2">
            <a href="<?= base_url(route_to("")) ?>" class="card text-white h-100 ps-2 pb-2  content-resume shadow-lg position-relative" " style=" background-color: <?= config("G3stor")->secondColor ?>;">
              <div class="card-body content-body position-relative d-flex justify-content-between align-items-center ps-5" style="background-color: <?= config("G3stor")->mainColor ?>">
                <img width="150px" height="150px" class="book-img position-absolute" src="<?= base_url("books-img.png") ?>" alt="">
                <div class="book-type " style="z-index: 30;">
                  <i class="fa-solid fa-list fa-3x"></i>
                  <h6 class="text-uppercase ">Categorias</h6>
                </div>
                <h1 class="fs-2 fw-normal me-3 position-absolute bottom-0 end-0">15</h1>
              </div>
            </a>
          </div> -->





          <!-- <hr class="border border-danger border-2 opacity-50"> -->

        </div>
      </div>

    </div>
  </section>


  <?= $this->endSection() ?>