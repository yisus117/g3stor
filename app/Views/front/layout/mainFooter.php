<footer class="text-center text-white" style="background-color: <?= Config("G3stor")->mainColor?>">

  <div class="container">
    <section class="mt-5">
      <div class="row text-center d-flex justify-content-center pt-5">
        <div class="col-md-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="<?= base_url(route_to("books")) ?>" class="text-white">Libros</a>
          </h6>
        </div>
        <div class="col-md-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="<?= base_url(route_to("students")) ?>" class="text-white">Estudiantes</a>
          </h6>
        </div>
        <div class="col-md-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="<?= base_url(route_to("books")) ?>" class="text-white">Sanciones</a>
          </h6>
        </div>
        <div class="col-md-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="<?= base_url(route_to("books")) ?>" class="text-white">Contacto</a>
          </h6>
        </div>
      </div>
    </section>
    <hr class="my-5" />
    <section class="mb-5">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
            distinctio earum repellat quaerat voluptatibus placeat nam.
          </p>
        </div>
      </div>
    </section>
  </div>
  <div class="flex text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © <?=  date("Y")?> Copyright. Todos los derechos reservados.
    <!-- <span>J3su</span> -->

  </div>

</footer>


