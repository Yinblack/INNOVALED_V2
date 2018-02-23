<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contacto</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" href="jquery.validate.css">
<script src="jquery.validate.js"></script>
<script src="validateContacto.js"></script>
<script language="JavaScript" type="text/javascript" xml:space="preserve">
$(document).ready(function() {
       $("#ContactForm").validate({
                  rules: {
                      "Nombre":     {
                                      	required :true
                                    },
                      "Correo"    : {
                                      	required :true,
                                      	email    :true
                                    },
                      "Telefono"   :{
                                        required :true,
                                        number    :true,
                                        minlength :6
                                    },
                      "Mensaje":   {
                                      	required :true
                                    }
                  },
                  messages: {
                      "Nombre":     {
                                      required :"El campo nombre requiere ser llenado"
                                    },
                      "Correo" :    {
                                      required :"El campo correo electronico requiere ser llenado",
                                      email    :"Escriba un correo valido ejemplo (correo@hotmail.com)"
                                    },
                      "Telefono":   {
                                      required :"El campo telefono requiere ser llenado",
                                      number :"Solo se permiten números",
                                      minlength : "Número mínimo de caracteres 6"
                                    },
                      "Mensaje":     {
                                      required :"Seleccione un tipo de mensaje"
                                    }
                  },
          submitHandler: function(form) {
              /*$("#cargador-enviando").css("display","inline-block");*/
              event.preventDefault();
              var v = grecaptcha.getResponse();
              if(v.length == 0) {

              }else{
                  form.submit();
                  $('#body-cargador').css('display','block');
                  $('#btn-enviar').css('display','none');
              }
          }
        });
       $("#btn-enviar").click(function(event){
          var v = grecaptcha.getResponse();
          if(v.length == 0) {
              $(".g-recaptcha").addClass('g-recaptcha-error');
              $(".error_captcha").css({ "display" : "block" });
          }else{
              $(".g-recaptcha").removeClass('g-recaptcha-error');
              $(".error_captcha").css({ "display" : "none" });
          }
       });
    });
    $(window).load(function(){
        //var altura=$('.row-medir-Comentarios').css('height');
        //$('.row-height-Comentarios').css('height',altura);
    });

</script>
</head>
<body>
	<div class="container-fluid text-center">
		<div class="col-lg-4 centerDiv">
			<form id="ContactForm" method="post" action="envio.php">
  				<div class="form-group">
  				  <label for="Nombre">Nombre</label>
  				  <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre">
  				</div>
  				<div class="form-group">
  				  <label for="Correo">Correo</label>
  				  <input type="email" class="form-control" name="Correo" id="Correo" placeholder="Correo">
  				</div>
  				<div class="form-group">
  				  <label for="Telefono">Telefono</label>
  				  <input type="text" class="form-control" name="Telefono" id="Telefono" placeholder="Telefono">
  				</div>
  				<div class="form-group">
  				  <label for="Mensaje">Mensaje</label>
  				  <textarea name="Mensaje" id="Mensaje" class="form-control" rows="3"></textarea>
  				</div>
  				<div class="form-group">
					<div class="g-recaptcha" data-sitekey="6LcQUCATAAAAADM1vQBUGtlFJ--NQgADIIB2Sm7L"></div>
					<label class="error" style="display: none;">Completa el captcha para enviar el formulario</p>
  				</div>
  				<button type="submit" name="btn-enviar" id="btn-enviar" class="btn btn-default">Enviar</button>
			</form>
		</div>
	</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');


    if(isset($_POST['Nombre']) 
      && isset($_POST['Email']) 
      && isset($_POST['Telefono']) 
      && isset($_POST['Interes']) 
      && isset($_POST['Mensaje']) 
      && isset($_POST['g-recaptcha-response'])){

$(document).ready(function() {

    $('#ContactForm').submit(function(event) {

        var formData = {
			      'Nombre': $('input[name=Nombre]').val(),
			      'Telefono': $('input[name=Telefono]').val(),
            'Email': $('input[name=Email]').val()
            'Interes': $('input[name=Interes]').val()
            'Mensaje': $('input[name=Mensaje]').val()
            'g-recaptcha-response': $('input[name=g-recaptcha-response]').val()
        };

		// process the form
		$.ajax({
		    type        : 'POST',
		    url         : 'envio.php',
		    data        : formData,
		    dataType    : 'json'
		})

		    .done(function(data) {
		        console.log(data);
		        if (data==true) {
             console.log('Envio confirmado');
             console.log(data);
		        } else {
		        	console.log('Problema al enviar');
             console.log(data);
		        }
		    })

    		.fail(function(data) {
		        console.log(data);
		        console.log('Problema peticion ajax');
    		});
        event.preventDefault();
    });
});

</script>
</body>
</html>
<style>
	.centerDiv{
		text-align: left;
    	float: none;
    	margin-left: auto;
    	margin-right: auto;
	}
	.g-recaptcha-error{
		border: 2px solid #f5811f !important;
	}
</style>