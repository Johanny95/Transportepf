var site_url  =  'http://192.168.25.44:8002/Transporte_pf/index.php/';
var base_url  =  'http://192.168.25.44:8002/Transporte_pf/';

function pf_notify(titulo,mensaje,tipo){
  var icon;
  if(tipo=='success'){
    icon='fa fa-check';  
  }else if(tipo=='danger'){
    icon='fa fa-ban';
  }else if(tipo=='warning'){
    icon='fa fa-warning';
  }else if(tipo=='info'){
    icon='fa fa-info-circle';
  }
  $.notify(
    { icon:icon,
      title: "<strong>"+titulo+"</strong> <br/>",
      message: mensaje
    },{
      type: tipo,
      showProgressbar: false,
      placement: {
        from: "bottom",
        align: "right"
      },
      delay: 3000,
      timer: 2000,
      z_index:9999,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      }
    }); 
}

