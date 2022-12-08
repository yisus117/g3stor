(function() {
  $(".delete").click(function(e) {
    e.preventDefault();
    var id = $(this).parents("tr").find("td:first").text();
    console.log(id);
    var name = $(this).attr("data-name");

    $(".delete").prop('disabled', true)
    $("a").removeAttr('href');

    swal
      .fire({
        title: "¿Eliminar?",
        text: '¿Realmente quieres eliminar el registro de "' + name + '" ?',
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: true
      })
      .then((isConfirmed) => {
        if (isConfirmed.value) {
          $.ajax({
            url: "/estudiantes/eliminar/" + id,
            success: function(response) {
              window.location.reload();
            },
            error: function() {
              swal.fire(
                "Error!",
                "Error al tratar de eliminar el registro",
                "warning"
              );
            },
          });
        } else {
          $(".delete").prop('disabled', false)
        }
      })
  });
  $(".delete").prop('disabled', false)

})();