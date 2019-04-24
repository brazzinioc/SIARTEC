
$(document).ready(function(){

    //Script para adicionar la clase active a las opciones del menú de administración.
    $('.sidebar-menu li:has(ul)').click( function(){
        //console.log("Hiciste clic en sidebar menu li");

        if($(this).hasClass('active')){
            $(this).removeClass('active');
        } else {
            $('.sidebar-menu li').removeClass('active');
            $(this).addClass('active');
        }
    });




    //Activación del plugin Numeric
    //Para el campo DNI
    $('#dni').numeric({
        negative:false
    });


    //Activación del plugin Select2
    //Initialize Select2 Elements
    $('.select2').select2();



    //Cambio de Idioma y envío de algunos parametros a plugin DataTables.
    $('#registros').DataTable({
        'paging'      : false, //Conpagina
        'pageLength'  : 6, //conpagina a partir de 6 registros.
        'lengthChange': false, //
        'searching'   : true, //buscador
        'ordering'    : true, //ordenar
        'info'        : true, 
        "scrollX"     : true,
        "scrollY"     : true,
        'autoWidth'   : false, //adaptabilidad
        'language'    :{
        paginate: {
            next: 'Siguiente',
            previous: 'Anterior',
            last: 'Último',
            first: 'Primero'
        },
        info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados', 
        emptyTable: 'No hay registros',
        infoEmpty: '0 Registros',
        search: 'Buscar',
        zeroRecords: "0 Resultados"
        }
    });




    //Activación del plugin Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      language: 'es'
    });

    //Setea la Fecha actual
    $('#fecha').datepicker('setDate', new Date() );



    //Activación del plugin Timepicker
    $('.timepicker').timepicker({

      minuteStep: 1,
      template: 'modal',
      appendWidgetTo: 'body',
      showSeconds: true,
      showMeridian: false,
      defaultTime: 'current'
    });
 

    // Gráfica de préstamos registrados por fecha usando morris(LINE CHART).
    // Usamos un servicio para obtener el json de préstamos registrados en la BD.
    if( document.querySelector('#grafica-prestamos') ) {
        
        $.getJSON('includes/servicios/servicio-prestamos.php', function(respuesta){

            var line = new Morris.Line({
            element: 'grafica-prestamos',
            resize: true,
            data: respuesta,
            xkey: 'fecha',
            ykeys: ['cantidad'],
            labels: ['Núm. de préstamos '],
            lineColors: ['#3c8dbc'],
            hideHover: 'auto'
            });

        });
    }




        /*
     * DONUT CHART
     * -----------
     */

     //Validamos si el contenedor existe.
    if( document.querySelector('#prestamosTipoUsuario') ){
        //Gráfico de Préstamo por tipo de usuario.
        $.getJSON('includes/servicios/servicio-prestamos-del-dia.php', function(respuesta){
      
          if(respuesta.datos == '0'){
            //Si no existe registros del día.Mostramos un mensaje
            $('#prestamosTipoUsuario')[0].innerHTML = '<p style="text-align:center; padding-top: 100px;" class="text-danger"> No hay registro de hoy día para mostrar el gráfico.</p>';

          } else {
            var donutData = [
                { label: `${ respuesta[0] ? respuesta[0].tipoUsuario: '' }`, data: `${ respuesta[0] ? respuesta[0].cantidad : 0 }`, color: '#00a65a' },
                { label: `${ respuesta[1] ? respuesta[1].tipoUsuario: ''  }`, data: `${ respuesta[1] ? respuesta[1].cantidad : 0}`,  color: '#d81b60' },
                { label: `${ respuesta[2] ? respuesta[2].tipoUsuario: ''  }`, data: `${ respuesta[2] ? respuesta[2].cantidad : 0}`,   color: '#555299' }
              ]
              $.plot('#prestamosTipoUsuario', donutData, {
                series: {
                  pie: {
                    show       : true,
                    radius     : 1,
                    innerRadius: 0.5,
                    label      : {
                      show     : true,
                      radius   : 2 / 3,
                      formatter: labelFormatter,
                      threshold: 0.1
                    }
          
                  }
                },
                legend: {
                  show: false
                }
            });

          } //fin if
        }); //fin getJSON.
    } //Fin de IF. Validación de contenedor.



     //Validamos si el contenedor existe.
    if( document.querySelector('#prestamosEstado')) {

        //Gráfico de Préstamos por estado.
        $.getJSON('includes/servicios/servicio-prestamo-estado.php', function(respuesta){
          
          if(respuesta.datos == '0'){
            //Si no existe registros del día.Mostramos un mensaje
            $('#prestamosEstado')[0].innerHTML = '<p style="text-align:center; padding-top: 100px;" class="text-danger"> No hay registro de hoy día para mostrar el gráfico.</p>';

          } else {
            var donutData = [
                { label: `${ respuesta[0] ? 'No Devueltos': '' }`, data: `${ respuesta[0] ? respuesta[0].cantidadNoDevueltos : 0 }`, color: '#00c0ef' },
                { label: `${ respuesta[1] ? 'Devueltos': ''  }`, data: `${ respuesta[1] ? respuesta[1].cantidadDevueltos : 0}`,  color: '#f39c12' }
              ]
              $.plot('#prestamosEstado', donutData, {
                series: {
                  pie: {
                    show       : true,
                    radius     : 1,
                    innerRadius: 0.5,
                    label      : {
                      show     : true,
                      radius   : 2 / 3,
                      formatter: labelFormatter,
                      threshold: 0.1
                    }
          
                  }
                },
                legend: {
                  show: false
                }
            });

          } //fin if
        }); //fin getJSON.
    } //Fin de IF. Validación de contenedor.



    //Validamos si el contenedor existe.
    if( document.querySelector('#prestamoTotalTipoUsuario') ){
      
        //Gráfico del TOTAL de Préstamos por tipo de usuario.
        $.getJSON('includes/servicios/servicio-prestamo-total-tipo-usuario.php', function(respuesta){
      
          if(respuesta.datos == '0'){
            //Si no existe registros del día.Mostramos un mensaje
            $('#prestamoTotalTipoUsuario')[0].innerHTML = '<p style="text-align:center; padding-top: 100px;" class="text-danger"> No hay registros en la base de datos para mostrar el gráfico.</p>';

          } else {
            var donutData = [
                { label: `${ respuesta[0] ? 'Alumnos': '' }`, data: `${ respuesta[0] ? respuesta[0].cantidadPrestamoAlumno : 0 }`, color: '#00a65a' },
                { label: `${ respuesta[1] ? 'Docentes': ''  }`, data: `${ respuesta[1] ? respuesta[1].cantidadPrestamoDocente : 0}`,  color: '#d81b60' },
                { label: `${ respuesta[2] ? 'Administrativos': ''  }`, data: `${ respuesta[1] ? respuesta[2].cantidadPrestamoAdministrativo : 0}`,  color: '#555299' }
              ]
              $.plot('#prestamoTotalTipoUsuario', donutData, {
                series: {
                  pie: {
                    show       : true,
                    radius     : 1,
                    innerRadius: 0.5,
                    label      : {
                      show     : true,
                      radius   : 2 / 3,
                      formatter: labelFormatter,
                      threshold: 0.1
                    }
          
                  }
                },
                legend: {
                  show: false
                }
            });

          } //fin if
        }); //fin getJSON
    }  //Fin de IF. Validación de contenedor.

    /* Custom Label formatter for Donut chart*/
    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:3px; color: black; font-weight: bold;">'
        + label
        + '<br>'
        + Math.round(series.percent) + '%</div>'
    }
    /** END DONUT CHART */



    /* OCULTA EL MENSAJE DE REPORTE. 
    **********************************/
    if( document.querySelector('.mensaje-reporte')){
      
      setTimeout(function(){ 
        $('.mensaje-reporte').remove();
      }, 5000);
    }






    /* SCRIPT PARA MANTENIMIENTO BASE DE DATOS. */
    $('#mantenimiento-bd').on('click', function(e){
      e.preventDefault();

       swal("Muy pronto!", "Funcionalidad en próxima actualización.");

    });

}); //Fin document.ready()

