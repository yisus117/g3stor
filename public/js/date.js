function actual() {
  fecha = new Date(); //Actualizar fecha.
  hora = fecha.getHours(); //hora actual
  minuto = fecha.getMinutes(); //minuto actual
  segundo = fecha.getSeconds(); //segundo actual
  if (hora < 10) {
    //dos cifras para la hora
    hora = "0" + hora;
  }
  if (minuto < 10) {
    //dos cifras para el minuto
    minuto = "0" + minuto;
  }
  if (segundo < 10) {
    //dos cifras para el segundo
    segundo = "0" + segundo;
  }
  //ver en el recuadro del reloj:
  mihora = hora + " : " + minuto + " : " + segundo;
  var options = {
    weekday: "long",
    month: "long",
    day: "numeric",
  };
  midate = fecha.toLocaleDateString("es-ES", options);
  return {
    mihora,
    midate,
  };
}
function actualizar() {
  let { mihora, midate } = actual();
  clock = document.getElementById("clock");
  date = document.getElementById("date");
  date.innerHTML = midate;
  clock.innerHTML = mihora;
}
setInterval(actualizar, 1000);

