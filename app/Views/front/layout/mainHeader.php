<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="background-color: <?= Config("G3stor")->mainColor ?> !important">
  <div class="container-fluid d-flex">
    <a class="navbar-brand flex-grow-1 fs-6" href="<?= base_url(route_to("home")) ?>">
      <i class="fa-solid fa-book-open-reader fs-4 ms-3 me-1"></i>
      Gestor de biblioteca
    </a>

    <div class="d-flex mt-3 fw-lighter" >
      <div id="date" class="date clock d-none d-sm-flex "></div>
      <div id="clock" class="clock fw-bolder">
        cargando...
      </div>
    </div>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= service("request")->uri->getPath() == "/" ? "active" : "" ?>" aria-current="page" href="<?= base_url(route_to("home")) ?>">Inicio</a>
        </li>

        <li class="nav-item">
          <div class="dropdown" style="max-width: 30%">
            <button class=" btn border-0 dropdown-toggle nav-link   <?= preg_match("|^libros(\S)*$|",  service("request")->uri->getPath(), $matches) ? "active" : "" ?>" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Libros
            </button>
            <ul class="dropdown-menu nav-item" style="background-color: <?= config("G3stor")->secondColor ?>">
              <li class="dropdown-link">
                <a class="dropdown-item nav-link ps-2 <?= service("request")->uri->getPath() == "libros" ? "active" : "" ?>" href="<?= base_url(route_to("books")) ?>">Ver</a>
              </li>
             
              <li>
                <a class="dropdown-item nav-link ps-2 <?= preg_match("|^libros/editoriales(\S)*$|",  service("request")->uri->getPath(), $matches) ? "active" : "" ?>" href="<?= base_url(route_to("editorials")) ?>">Editoriales</a>
              </li>

              <li>
                <a class="dropdown-item nav-link ps-2 <?= preg_match("|^libros/autores(\S)*$|",  service("request")->uri->getPath(), $matches) ? "active" : "" ?>" href="<?= base_url(route_to("autors")) ?>">Autores</a>
              </li>

            </ul>
          </div>
        </li>


        <li class="nav-item">
          <a class="nav-link <?= preg_match("|^estudiantes(\S)*$|",  service("request")->uri->getPath(), $matches) ? "active" : "" ?>" href="<?= base_url(route_to("students")) ?>">Estudiantes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= preg_match("|^sanciones(\S)*$|",  service("request")->uri->getPath(), $matches) ? "active" : "" ?>" href="<?= base_url(route_to("")) ?>">Sanciones</a>
        </li>

        <?php if(session()->get('user_role') === "master"){ ?>
          <li class="nav-item">
          <a class="nav-link <?= preg_match("|^sanciones(\S)*$|",  service("request")->uri->getPath(), $matches) ? "active" : "" ?>" href="<?= base_url(route_to("")) ?>">Usuarios</a>
        </li>
        <?php } ?>

        <?php if( session()->get('user_role') === "master" || session()->get('user_role') === "admin"){ ?>
          <li class="nav-item">
          <a class="nav-link <?= preg_match("|^sanciones(\S)*$|",  service("request")->uri->getPath(), $matches) ? "active" : "" ?>" href="<?= base_url(route_to("")) ?>">Auditoria</a>
        </li>
        <?php } ?>


      </ul>
    </div>

  </div>
</nav>
