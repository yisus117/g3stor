<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5.2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- font awensome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SweetAlert 2  -->
    <link rel="stylesheet" href="<?= base_url("/css/sweetalert2.min.css") ?>">

  <!-- Google font - Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url("/css/styles.css"); ?>">

  <?= $this->renderSection("css") ?>

  <title><?= $this->renderSection("title") ?> &nbsp;-&nbsp; G3stor</title>
</head>

<body style="background-color: <?= Config("G3stor")->bodyColor ?>; color:  <?= Config("G3stor")->textColor ?>">
  <section class="section">

    <?php if (session("msg")) : ?>
      <div class="card w-75 bg-<?= session("msg.type"); ?>">
        <div class="card-body">
          <h5 class="card-title">Alerta</h5>
          <p class="card-text"> <?= session("msg.body"); ?></p>
        </div>
      </div>

    <?php endif ?>

    <?= $this->renderSection("content") ?>

  </section>
  

  <!-- Bootstrap JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="<?= base_url("/js/jquery.min.js") ?>"></script>
  <script src="<?= base_url("/js/sweetalert2.min.js") ?>"></script>



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