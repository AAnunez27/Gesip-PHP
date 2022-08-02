//Inicialización 
$(document).ready(function(){
  $('#modal').modal();
  $('#modalses').modal();
  $('select').formSelect();
  $('.datepicker').datepicker({ 
    firstDay: true, 
    format: 'dd-mmmm-yyyy',
    i18n: {
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
        weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"]
    }
  });
  $('.dropdown-trigger').dropdown();
  //para que el text area de agregar dispositivos se agrande automatico
  $('#obs_dis').val();
  M.textareaAutoResize($('#obs_dis'));
});