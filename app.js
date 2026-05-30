function sesion(n){//Se utliza para el boton de iniciar sesión en dado caso que ya este iniciado se abre un menu y se puede salir notificando en ambos casos.
  if (n == 1) {
    alert("¡Vuelva pronto!");
  }
  if (n == 2) {
    alert("Inicie sesión por favor");
    window.location.href='cuenta.php';
  }
}

  function post() {//Se quita el atrributo del form, para convertirlo en boton, y así mismo mandar los datos para que se pueden agregar los productos al carrito.

    var form = document.getElementById("form");
    form.removeAttribute("action");
    var boton = document.getElementById("miBoton");
    boton.removeAttribute("onclick");
    boton.setAttribute("type", "submit");
    boton.setAttribute("name", "carrito");

  }

  function compra() {//Al apretar el boton comprar se agrega el link al atributo action para que pueda realizar su pago.
    var form = document.getElementById("form");
    form.setAttribute("action","paypal"); //La accion manda a la pagina de pago de paypal, lo cual esta desactivado en el proyecto.
  }

  function paypal(){//Se cambian varios datos del form para que antes de terminar con el pedido, proceda al pago, inmediatamente cambia el formulario para poder escribir la información de entrega.

      var form = document.getElementById('myForm');
      form.setAttribute("action","paypal"); //La accion manda a la pagina de pago de paypal, lo cual esta desactivado en el proyecto.
      form.setAttribute("target","_blank")
      form.submit();
      var submitButton = document.getElementById('submitButton');
      submitButton.value = "Guardar Pedido";
      submitButton.setAttribute("type", "submit");
      submitButton.setAttribute("name", "comprar");
      submitButton.removeAttribute("onclick");
      submitButton.setAttribute("onclick","cambiar()");
      var div1 = document.getElementById("nota");
      div1.setAttribute("hidden", 'true');
      var div2 = document.getElementById("entrega");
      div2.removeAttribute("hidden");

  }

  function cambiar(){//Cambia la acción para que se abra en una nueva pestaña.
    var form = document.getElementById('myForm');
    form.removeAttribute("action");
    form.removeAttribute("target");
  }