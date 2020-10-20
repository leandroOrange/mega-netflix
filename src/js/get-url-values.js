$(document).on("submit", "form", function() {
  var context = $(this);
  context.find(".form-status").hide();
  context
    .find(".form-status .error-text")
    .html("Debe ingresar un numero de 10 digitos.");

  var tel = context.find('input[name="tel"]').val();
  if (tel.length == 10) {
    //context.find(".form-sending").show();
    $(".fixed-send-form").addClass("show");

    var data = {
      serviceToken: theToken, // Token de identificación de campaña
      serviceAction: "c2c", // Canal en el que se procesará el lead ingresado (c2c / form)
      contentUrl: window.location.href, // URL en la que se generó el lead
      contactData: {
        phone: $(this)
          .find('input[name="tel"]')
          .val() // Teléfono del contacto (se utilizará para procesar el canal c2c)
      }
    };

    var settings = {
      method: "POST",
      url: "https://megacable.convertia.com/public/integration/process",
      contentType: "application/json",
      dataType: "json",
      data: JSON.stringify(data),
      async: true,
      crossDomain: true,
      processData: false
    };

    $.ajax(settings).done(function(response) {
      if (response.status) {
        console.log("done");
        var p = window.location.search;
        p = p.replace("page=entry", "page=typ");
        window.location.href = "gracias.php" + p;
        return false;
      } else {
        console.log("error");
        context
          .find(".form-status .error-text")
          .html("Error interno: " + response.error);
        context.find(".form-status").show();
      }

      //context.find(".form-sending").hide();
      $(".fixed-send-form").removeClass("show");
      //console.log(response);
    });
  } else {
    context.find(".form-status").show();
  }

  return false;
});
