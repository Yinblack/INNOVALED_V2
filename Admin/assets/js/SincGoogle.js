var loadApiGoogle;
window.loadApiGoogle = false;

$(function() {
  $('button#SincGoogle').click(function() {
    renderButton();
    setTimeout(function() {
      renderButton();
    }, 300);
  });
});

$(function() {
  $('button#UnsincGoogle').click(function() {
      confirm('¿Realmente desea desvincular la cuenta Google?', unsyncGoogleAjax, '');
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

    var EmailGoogle=(profile.getEmail());
    var IdGoogle=(profile.getId());
    var IdContacto=$('input#IdContacto').val();

    var formData = new FormData();
    
    formData.append('EmailGoogle', EmailGoogle);
    formData.append('IdGoogle', IdGoogle);
    formData.append('IdContacto', IdContacto);
    $.ajax({
        url: window.base_url+'Persona_c/SincGoogle',
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
            notification('<strong>Cuenta vinculada</strong>','success','topRight');
            setTimeout(function() {
              location.reload();
            }, 350);
          }else if (data=='IdOcupada') {
            notification('La cuenta Google ya esta en uso con otra cuenta Vaeo Advance','warning','topRight');
          }else{
            notification('Ocurrio un error','error','topRight');
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

function unsyncGoogleAjax(){
    var IdContacto=$('input#IdContacto').val();
    var formData = new FormData();
    formData.append('IdContacto', IdContacto);
    $.ajax({
        url: window.base_url+'Persona_c/UnsyncGoogle',
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
            notification('<strong>Cuenta desvinculada</strong>','success','topRight');
            setTimeout(function() {
              location.reload();
            }, 350);
          }else{
            notification('Ocurrio un error','error','topRight');
          }
          console.log(data);
        },
        error: function(data){
          console.log('Error Ajax Peticion');
          console.log(data);
        }
    });
}