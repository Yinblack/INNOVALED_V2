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
  console.log('onSuccess');
    var profile = googleUser.getBasicProfile();
    var IdGoogle=(profile.getId());
    var NameGoogle=(profile.getName());
    var EmailGoogle=(profile.getEmail());
    var ImageGoogle=(profile.getImageUrl());
    var formData = new FormData();
    formData.append('IdGoogle', IdGoogle);
    formData.append('Nombre', NameGoogle);
    formData.append('Email', EmailGoogle);
    formData.append('ImageGoogle', ImageGoogle);
    $.ajax({
        url: window.base_url+'Persona_c/addUsuario',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          console.log('Procesando');
        },
        success: function(data){
          if (data=='success') {
            notification('Usuario agregado','success','topRight');
          }else if (data=='emailOcupado') {
            notification('El Email ya esta ocupado','warning','topRight');
          }else{
            notification('Problema al agregar','error','topRight');
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
