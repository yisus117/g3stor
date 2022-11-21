
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
  
<!-- Gutter g-1 -->
<div class="row g-1">
  <div class="col">
    <!-- Name input -->
    <div class="form-outline">
      <input type="text" id="form9Example1" class="form-control" />
      <label class="form-label" for="form9Example1">Name</label>
    </div>
  </div>
  <div class="col">
    <!-- Email input -->
    <div class="form-outline">
      <input type="email" id="form9Example2" class="form-control" />
      <label class="form-label" for="form9Example2">Email address</label>
    </div>
  </div>
</div>

<hr />

<!-- Gutter g-5 -->
<div class="row g-5">
  <div class="col">
    <!-- Name input -->
    <div class="form-outline">
      <input type="text" id="form9Example3" class="form-control" />
      <label class="form-label" for="form9Example3">Name</label>
    </div>
  </div>
  <div class="col">
    <!-- Email input -->
    <div class="form-outline">
      <input type="email" id="form9Example4" class="form-control" />
      <label class="form-label" for="form9Example4">Email address</label>
    </div>
  </div>
</div>



</div>

</section>


<?= $this->endSection() ?>

