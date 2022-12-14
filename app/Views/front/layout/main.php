<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5.2 -->
  <link rel="stylesheet" href="<?= base_url("/css/bootstrap.min.css") ?>">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->

  <!-- font awensome icons -->
  <link rel="stylesheet" href="<?= base_url("/css/all.min.css") ?>">
  <!-- <script src="https://kit.fontawesome.com/b19bd6df60.js" crossorigin="anonymous"></script> -->

  <!-- SweetAlert 2  -->
  <link rel="stylesheet" href="<?= base_url("/css/sweetalert2.min.css") ?>">
  <!-- <script src="https://kit.fontawesome.com/b19bd6df60.js" crossorigin="anonymous"></script> -->

  <!-- Google font - Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Animate CSS -->
  <link rel="stylesheet" href="<?= base_url("/css/animate.min.css") ?>">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> -->

  <!-- Styles owns -->
  <link rel="stylesheet" href="<?php echo base_url("/css/styles.css"); ?>">

  <!-- clock date -->
  <script src="<?= base_url("/js/date.js") ?>"></script>

  <?= $this->renderSection("css") ?>


  <title><?= $this->renderSection("title") ?> &nbsp;-&nbsp; G3stor</title>
</head>

<body style="background-color: <?= Config("G3stor")->bodyColor ?>; color:  <?= Config("G3stor")->textColor ?>">
  <?= $this->include('front/layout/mainHeader') ?>

  <nav class="navbar navbar-expand-lg py-0 ps-4 position-relative" style="height: 70px;background-color: <?= Config("G3stor")->mainColor ?>">
    <?= $this->renderSection("breadCrumb") ?>

    <?php if (session("msg")) : ?>

      <div class="m-0 me-3 mx-5 position-absolute p-0 animate__animated animate__bounceInRight" data-class="btn-close" style="top: 15px; right: 15px; z-index: 99;">
        <div class="alert alert-<?= session("msg.type"); ?> border-<?= session("msg.type"); ?> border-2 alert-dismissible fade show" role="alert" style="padding: 0 !important;">
          <p class="fs-6 me-4 mt-2 px-4"><?= session("msg.body"); ?></p>
          <button type="button" class="btn-close p-0 top-50 end-0 translate-middle" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    <?php endif ?>

    <div class="m-0 me-3 mx-5 d-flex gap-md-2 gap-1 align-items-center  position-absolute text-white text-capitalize p-0" style="top: 17px; right: 15px; z-index: 99;">
     <p class="m-0 fw-bold"> <i class="fa-solid fa-user me-2  fs-6" style="color: #0ebb60;"></i> <smal class="text-wrap"><?= session()->user_name ?></small></p>


      <a class="btn btn-danger p-1 px-2" href="<?= base_url(route_to("signout")) ?>">
        <i class="fa-solid fa-right-from-bracket "></i>
      </a>

    </div>



  </nav>



  <?= $this->renderSection("content") ?>
  <?= $this->include('front/layout/mainFooter') ?>


  <!-- Bootstrap JavaScript Bundle with Popper -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->

  <script src="<?= base_url("/js/bootstrap.bundle.min.js") ?>"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
  <script src="<?= base_url("/js/jquery.min.js") ?>"></script>
  <script src="<?= base_url("/js/sweetalert2.min.js") ?>"></script>


  <?= $this->renderSection("js") ?>
  <script>
    (function() {
      'use strict'
      const forms = document.querySelectorAll('.requires-validation')
      Array.from(forms)
        .forEach(function(form) {
          form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      <?php if (session()->getFlashdata("status_text")) { ?>
        Swal.fire({
          icon: '<?= session()->getFlashdata("status_icon") ?>',
          title: '<?= session()->getFlashdata("status") ?>',
          text: '<?= session()->getFlashdata("status_text") ?>'
        })

      <?php } else if (session()->getFlashdata("status")) { ?>
        const Toast = swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 4000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          title: '<?= session()->getFlashdata("status") ?>',
          icon: '<?= session()->getFlashdata("status_icon") ?>'
        })


      <?php }  ?>
    })
  </script>





</body>

</html>