
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
        'paging'      : true, //Conpagina
        'pageLength'  : 6, //conpagina a partir de 6 registros.
        'lengthChange': false, //
        'searching'   : true, //buscador
        'ordering'    : true, //ordenar
        'info'        : true, 
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
        search: 'Buscar'
        }
    });


});