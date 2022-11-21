<?= $this->extend('auth/layout/main') ?>

<?= $this->section('title') ?>
Login
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section min-vh-100 d-flex justify-content-center align-items-center">
  <div class="container d-flex flex-column align-items-center justify-content-between" style="width: 500px;">
    <h3 class="h2 mb-4">Ingresar</h3>
    <form action="<?= base_url(route_to("signin")) ?>" method="POST">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Correo</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
      </div>
      <button type="submit" class="btn mt-5 py-3 w-100 text-white" style="background-color: <?= Config("G3stor")->mainColor ?> ;">Ingresar</button>
    </form>

  </div>
</section>


<?= $this->endSection() ?>