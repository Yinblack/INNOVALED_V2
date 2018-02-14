var loadApiGoogle;
window.loadApiGoogle = false;

$(function() {
  $('button#Gmail').click(function() {
    renderButton();
    setTimeout(function() {   //calls click event after a certain time
      renderButton();
    }, 300);
  });
});

function renderButton() {
  if (window.loadApiGoogle==true){
    $('div#my-signin2>div').click();
  }else{
    $.ajax({
      url: 'https://apis.google.com/js/platform.js',
      dataType: "script",
      success: function(){
        gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
        });
      }
    }).then(function() {
      window.loadApiGoogle = true;
    });
  }
}

function onSuccess(googleUser) {
    var profile = googleUser.getBasicProfile();
    var IdGoogle=(profile.getId());
    var formData = new FormData();
    formData.append('IdGoogle', IdGoogle);
    $.ajax({
        url: window.base_url+'Persona_c/LoginFromGmail',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
        },
        success: function(data){
          if (data=='success'){
            notification('Inicio de sesión <strong>Correcto!</strong>','success','topRight');
            setTimeout(function() {   //calls click event after a certain time
              location.reload();
            }, 350);
          }else{
            notification('Usuario o contraseña incorrectos','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}

function onFailure(error) {
    console.log('Error gmail');
}
